<?php 

namespace App\Services;

use Carbon\Carbon;

use App\Models\Property;
use App\Models\LeaseAgreements;
use App\Models\Payments;

class NotificationService{

    public function findNotifications($userId){
        $status = [];
        $leases = Property::with(['leases.propertyId'])->where('landlord_id', $userId)->get()->pluck('leases')->toArray();

        foreach (array_column($leases, 0) as $lease) {
          $paymentDate = $lease['payment_date'];
          $propertyName = $lease['property_id']['name'];
          $leaseId = $lease['id'];
          $parsedPaymentDate = Carbon::parse($paymentDate);
          $paymentDueDate = Carbon::now()->setDay($parsedPaymentDate->day)->startOfDay();
          
          $now = Carbon::now();
          $days = $now->diffInDays($paymentDueDate, false);

           $notification = $this->filterNotification($leaseId, $propertyName, $days);
           if($notification){
            $status[] = $notification;
           }
          
        }

        return $status;
    }

    private function filterNotification($leaseId, $propertyName, $days){
       
        $payment = Payments::where('lease_id', $leaseId)->first();

        if ($days >= 0) {
            $status = ($days == 0) ? 'Hoy es la fecha de cobro de ' . $propertyName : (($days <= 2) ? 'Fecha de cobro de '. $propertyName . ' se va acercando' : 'Cobro de alquiler de ' . $propertyName .  ' es en '. $days . ' días');
            return $status;
        }

          
    }
}