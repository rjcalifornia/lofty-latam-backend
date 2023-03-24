<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\LeaseAgreements;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Services\PaymentService;


class PaymentsController extends Controller{

    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function storePayment(Request $request){
        $validator = Validator::make($request->all(),[
            'lease_id' => 'required|integer',
            'payment_type_id' => 'required|integer',
            'payment' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }
        
        $payment = $this->paymentService->save($request);

        return response()->json($payment, 201);
    }

    public function paymentsHistory(Request $request, $id){
       $lease = LeaseAgreements::where('id', $id)->where('active', true)->first();

        if(!$lease){
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        $payments = $this->paymentService->history($lease);

        return response()->json($payments, 200);

    }
}
