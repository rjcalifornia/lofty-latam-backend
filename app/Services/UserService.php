<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Enums\RolesEnum;
use App\Models\User;
use App\Models\Roles;

class UserService
{

    public function createUser($request)
    {
        try {
            $user = new User;
            $rol = Roles::where('name', RolesEnum::LANDLORD)->where('active', true)->first();
            DB::transaction(function () use ($request, $user, $rol) {
                $user->name = $request->get('name');
                $user->lastname = $request->get('lastname');
                $user->username = $request->get('username');
                $user->email = $request->get('email');
                $user->phone = $request->get('phone');
                $user->dui = $request->get('dui');
                $user->is_admin = false;
                $user->active = true;
                $user->id_rol = $rol->id;
                $user->password = bcrypt($request->get('password'));
                $user->save();
            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function jwtTokenRequest($request){
        $user = User::with(['rol'])->where('dui', $request->dui)->first();

        $user->first_name = strtok($user->name, " ");
        $user->first_lastname = strtok($user->lastname, " ");
        $user->rol_name = $user->rol->name;
        $token = $user->createToken('auth_token', ['server:landlord'])->plainTextToken;

        $payload = ['user'=> $user, 'access_token'=> $token];

        return $payload;

    }
}
