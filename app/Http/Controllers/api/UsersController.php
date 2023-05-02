<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UsersController extends Controller{
    public function userProfile(Request $request){
        $user = Auth::user();

        $userProfile = User::with(['rol'])->where('id', $user->id)->first();
        return response()->json($userProfile, 200);
    }
}
