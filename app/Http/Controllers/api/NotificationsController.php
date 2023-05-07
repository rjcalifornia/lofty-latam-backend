<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Property;
use App\Models\LeaseAgreements;

class NotificationsController extends Controller{
    public function paymentStatus(Request $request){
        $user = Auth::user();
        $status = [];
        $leases = Property::with(['leases.propertyId'])->where('landlord_id', $user->id)->get()->pluck('leases')->toArray();
        foreach (array_column($leases, 0) as $lease) {
          $paymentDate = $lease['payment_date'];
          $properyName = $lease['property_id']['name'];
          $parsedPaymentDate = Carbon::parse($paymentDate);
          $paymentDueDate = Carbon::now()->setDay($parsedPaymentDate->day)->startOfDay();
          
          $now = Carbon::now();
          $days = $now->diffInDays($paymentDueDate, false);
          if ($days >= 0) {
            $status[] = ($days == 0) ? 'Hoy es la fecha de cobro de ' . $properyName : (($days <= 2) ? 'Fecha de cobro de '. $properyName . ' se va acercando' : 'Cobro de alquiler de ' . $properyName .  ' es en '. $days . ' días');
          }
        }
        
       

        return response()->json(['payment_notifications' =>$status], 200);
    }
}
