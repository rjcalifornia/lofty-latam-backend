<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserService
{
    public function validateFields($request)
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

        if ($validator->fails()) {
            return $validator->messages();
        }

        return null;
    }

    public function createUser($request)
    {
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

        return $user;
    }
}
