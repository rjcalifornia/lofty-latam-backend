<?php 

namespace App\Services;

use Carbon\Carbon;

use App\Models\Property;
use App\Models\LeaseAgreements;
use App\Models\Payments;

class NotificationService{

    public function findNotifications($userId){
        $status = [];
        $leases = Property::with(['leases.propertyId', 'leases.tenantId'])->where('landlord_id', $userId)->get()->pluck('leases')->flatten();
       // collect($leases);
       $i = 0;
        foreach ($leases as $lease) {
           $paymentDate = $lease->payment_date;
           $propertyName = $lease['propertyId']->name;
        //   $lease = $lease;
           $parsedPaymentDate = Carbon::parse($paymentDate);
           $paymentDueDate = Carbon::now()->setDay($parsedPaymentDate->day)->startOfDay();
          
          $now = Carbon::now();
          $days = $now->diffInDays($paymentDueDate, false);
            $status[]= $lease['id'];
           $notification = $this->filterNotification($lease, $propertyName, $days);
           if($notification){
            $status[$i] = $notification;
            $i++;
           }
          
        }

        return $status;
    }

    public function alerts($userId){
        $alerts = [];
        $leases = Property::with(['leases.propertyId'])->where('landlord_id', $userId)->get()->pluck('leases')->toArray();

        foreach (array_column($leases, 0) as $lease) {
          
            $propertyName = $lease['property_id']['name'];
            $leaseId = $lease['id'];

            $previousMonth = Carbon::now()->subMonth()->month;
            $currentYear = Carbon::now()->year;

            $payment = Payments::where('lease_id', $leaseId)
                ->where('month_cancelled', $previousMonth)
                ->whereYear('payment_date', $currentYear)
                ->first();

            if(!$payment){
            $alerts[] = 'La propiedad ' . $propertyName . ' tiene un cobro pendiente del mes pasado.';
            }
          
        }

        return $alerts;
    }

    private function filterNotification($lease, $propertyName, $days){
       
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $payment = Payments::where('lease_id', $lease->id)
                        ->where('month_cancelled', $currentMonth)
                        ->whereYear('payment_date', $currentYear)
                        ->first();

        if ($days >= 0 && !$payment) {
            $status = ($days == 0) ? 'Hoy es la fecha de cobro de ' . $propertyName : (($days <= 2) ? 'Fecha de cobro de '. $propertyName . ' se va acercando' : 'Cobro de alquiler de ' . $lease['tenantId']->tenant_full_name .  ' es en '. $days . ' días');
            return $status;
        }

          
    }
}