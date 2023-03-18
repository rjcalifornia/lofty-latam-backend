<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['mensaje' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        // Retrieve the user from the database based on the username
        $user = User::where('username', $request->username)->first();

        // If the user is not found or the password is incorrect, return an error
        if (! $user || ! password_verify($request->password, $user->password)) {
            return response()->json(['message' => 'Verifique los datos ingresados e intente nuevamente'], 401);
        }

        // Generate a token using Sanctum
        $token = $user->createToken('auth_token', ['server:landlord'])->plainTextToken;

        // Return the token as a response
        return response()->json(['access_token' => $token]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|confirmed', 
            'phone' => 'required|string',
            'dui' => 'required|string|unique:users',
            'email' => 'required|string|unique:users',
        ]);
        

        if($validator->fails()){
            return response()->json([$validator->messages()], 422);
        }

        // Create the new user
        $user = new User;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->dui = $request->dui;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_rol = 3;
        $user->is_admin = false;
        $user->active = true;
        $user->save();

        // Generate a token using Sanctum
        $token = $user->createToken('auth_token', ['server:landlord'])->plainTextToken;

        // Return the token as a response
        return response()->json(['access_token' => $token], 201);
    }
}
