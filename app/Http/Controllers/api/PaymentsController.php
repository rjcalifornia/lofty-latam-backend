<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use Illuminate\Http\Request;

use App\Models\LeaseAgreements;
use App\Models\Payments;

use App\Services\PaymentService;
use App\Services\PropertyService;

class PaymentsController extends Controller{

    protected $paymentService;
    protected $propertyService;
    public function __construct(PaymentService $paymentService, PropertyService $propertyService)
    {
        $this->paymentService = $paymentService;
        $this->propertyService = $propertyService;
    }

    public function storePayment(Request $request){
        $validator = Validator::make($request->all(),[
            'lease_id' => 'required|integer',
            'payment_type_id' => 'required|integer',
            'payment' => 'required|numeric',
            'month_cancelled' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        $lease = LeaseAgreements::where('id', $request->get('lease_id'))->first();

        if (!$this->propertyService->verifyProperty($lease->property_id)) {
            return response()->json(['message' => 'No se encontró propiedad. Revise los datos ingresados e intente nuevamente'],404);
        }
        
        $payment = $this->paymentService->save($request, $lease);

        return response()->json($payment, 201);
    }

    public function printPaymentReceipt(Request $request){
        $validator = Validator::make($request->all(),[
            'payment_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        $receipt = Payments::with(['leaseId'])->where('id', $request->get('payment_id'))->first();

        if (!$this->propertyService->verifyProperty($receipt->leaseId->property_id)) {
            return response()->json(['message' => 'No se encontró propiedad. Revise los datos ingresados e intente nuevamente'],404);
        }

        return $this->paymentService->generatePDF($request->get('payment_id'));
    }

    public function paymentsHistory(Request $request, $id){
       $lease = LeaseAgreements::where('id', $id)->where('active', true)->first();

        if(!$lease){
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        if (!$this->propertyService->verifyProperty($lease->property_id)) {
            return response()->json(['message' => 'No se encontró propiedad. Revise los datos ingresados e intente nuevamente'],404);
        }

        $payments = $this->paymentService->history($lease);

        return response()->json($payments, 200);

    }

    public function viewReceiptAttestationPublic(Request $request, $uuid){
        $receipt = Payments::with(['paymentTypeId', 'leaseId.propertyId'])->where('uuid', $uuid)->first();
        return response()->json($receipt, 200);
    }

    public function printReceiptAttestationPublic(Request $request, $uuid){
        $payment = Payments::where('uuid', $uuid)->first();
        if (!$payment) {
            return response()->json(['message' => 'No se puede procesar la solicitud. Verifique los datos e intente nuevamente'], 404);
        }
        return $this->paymentService->generatePDF($payment->id);
    }

    public function sendPaymentReceipt(Request $request){
        $validator = Validator::make($request->all(),[
            'payment_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        $receipt = Payments::with(['leaseId.tenantId'])->where('id', $request->get('payment_id'))->first();

        if (!$this->propertyService->verifyProperty($receipt->leaseId->property_id)) {
            return response()->json(['message' => 'No se encontró propiedad. Revise los datos ingresados e intente nuevamente'],404);
        }

        if(!$receipt->leaseId->tenantId->email){
            return response()->json(['message' => 'Usuario no tiene correo electrónico. Por favor agregue una dirección de correo e intente nuevamente']);
        }

        try {
            //return $receipt;
            Mail::to($receipt->leaseId->tenantId->email)->send(new VerificationEmail($receipt));
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return response()->json(['message' =>'Recibo digital enviado exitosamente'], 200);
        

    }
}
