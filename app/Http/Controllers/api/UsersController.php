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
            'old_password' => 'required|string',
            'password' => 'required|string|same:repeat_password|min:6',
            'repeat_password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        $userId = Auth::user();
        $user = User::where('id', $userId->id)->first();
        if (!$user or !$user->active) {
            return response()->json(['message' => 'Verifique los datos ingresados e intente nuevamente', 401]);
        }

        if (! password_verify($request->get('old_password'), $user->password)) {
            return response()->json(['message' => 'Clave anterior no es la correcta. Revise los datos e intente nuevamente'], 422);
        }

        DB::transaction(function () use ($request, $user) {
            $user->password = bcrypt($request->get('password'));
            $user->save();
        });
        
        return response()->json([],204);

    }

    public function getUserDetails(Request $request){
        $user = Auth::user();

        $userDetails = User::with(['rol'])->where('id', $user->id)->first();
        return response()->json($userDetails, 200);
    }

    public function updateUserDetails(Request $request){

        $user = User::where('id', Auth::user()->id)->first();

        if ($request->has('name') && $request->has('lastname')) {
            $user->name = $request->get('name');
            $user->lastname = $request->get('lastname');
            $user->save();
            return response()->json(204);
        }

        if ($request->has('phone')) {
            $user->phone = $request->get('phone');
            $user->save();
            return response()->json(204);
        }

        if ($request->has('email')) {
            $user->email = $request->get('email');
            $user->save();
            return response()->json(204);
        }

        return response()->json(['message' => 'No se puede procesar la solicitud debido a que no ha llenado los campos requeridos'], 422);
    }

}
