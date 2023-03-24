<?php

namespace App\Services;

use App\Models\Property;
use App\Models\LeaseAgreements;
use App\Models\PaymentType;
use App\Models\Payments;

use Carbon\Carbon;


class PaymentService{

    public function save($request){
        $lease = LeaseAgreements::where('id', $request->get('lease_id'))->first();
        $paymentType = PaymentType::where('id', $request->get('payment_type_id'))->first();

        $payment_date =  Carbon::now();

        $payment = new Payments([
            'lease_id' => $lease->id,
            'payment_type_id' => $paymentType->id,
            'payment_date' => $payment_date->format('Y-m-d'),
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

}