<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class UsersController extends Controller{
    public function userProfile(Request $request){
        $user = Auth::user();

        $userProfile = User::with(['rol'])->where('id', $user->id)->first();
        return response()->json($userProfile, 200);
    }

    public function changePassword(Request $request){

        $validator = Validator::make($request->json()->all(),[
            'password' => 'required|string|same:repeat_password|min:6',
            'repeat_password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        $userId = Auth::user();
        $user = User::where('id', $userId->id)->first();
        if (!$user or !$user->active) {
            return response()->json(['message' => 'Verifique los datos ingresados e intente nuevamente', 404]);
        }
        DB::transaction(function () use ($request, $user) {
            $user->password = bcrypt($request->get('password'));
            $user->save();
        });
        
        return response()->json([],204);

    }

}
