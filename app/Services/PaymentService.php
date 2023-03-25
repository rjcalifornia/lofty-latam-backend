<?php

namespace App\Services;

use App\Models\Property;
use App\Models\LeaseAgreements;
use App\Models\PaymentType;
use App\Models\Payments;

use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class PaymentService{

    public function save($request){
        $lease = LeaseAgreements::where('id', $request->get('lease_id'))->first();
        $paymentType = PaymentType::where('id', $request->get('payment_type_id'))->first();

        $payment_date =  Carbon::now();
        $month_cancelled =  Carbon::parse($request->get('month_cancelled'));
        $payment = new Payments([
            'lease_id' => $lease->id,
            'payment_type_id' => $paymentType->id,
            'payment_date' => $payment_date->format('Y-m-d'),
            'month_cancelled' => $month_cancelled->format('Y-m-d'),
            'payment' => $lease->price,
            'user_creates' => auth()->user()->id,
           
        ]);

        try {
            $payment->save();
        } catch (\Throwable $th) {
            return $th;
        }
        
        return $payment;
    }

    public function history($lease){
        $payments = Payments::with(['paymentTypeId', 'leaseId.tenantId'])->where('lease_id', $lease->id)->get();
        return $payments;
    }

    public function generatePDF($paymentId){
        $payment = Payments::with(['leaseId.tenantId', 'leaseId.propertyId.landlordId','paymentTypeId'])->where('id', $paymentId)->first();

        $html = View::make('pdf.payment', compact('payment'))->render();
        
        TCPDF::setMargins(14, 16, 14, true);
        TCPDF::AddPage();
        TCPDF::setImageScale(1);
        TCPDF::SetAutoPageBreak(false, 0);

       TCPDF::writeHTML($html, true, false, true, false, '');

       

        return TCPDF::Output("test.pdf", 'I');
    }

}