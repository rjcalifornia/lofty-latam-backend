<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Services\NotificationService;

class NotificationsController extends Controller{
  protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }


    public function paymentStatus(Request $request){
        $user = Auth::user();
        
        $status = $this->notificationService->findNotifications($user->id);

        
        
        return response()->json(['payment_notifications' =>$status], 200);
    }
}
