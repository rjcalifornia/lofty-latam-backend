<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail; 
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;

use App\Enums\RolesEnum;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserVerify;
use App\Models\Property;
use App\Models\LeaseAgreements;
use App\Models\UserLocation;

class UserService
{

    public function createUser($request)
    {
        try {
            $user = new User;
            $userLocation = new UserLocation;
            $rol = Roles::where('name', RolesEnum::LANDLORD)->where('active', true)->first();
            DB::transaction(function () use ($request, $user, $rol, $userLocation) {
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
                
                $userLocation->user_id = $user->id;
                $userLocation->distrito_id = $request->get('distrito_id');
                $userLocation->active = true;
                $userLocation->user_creates = $user->id;
                $userLocation->save();
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

    public function sendVerificationEmail($user){
        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        $logo = storage_path('img/email.png');
        $img = base64_encode(file_get_contents($logo));

        try {
            Mail::send('email.verification-email', ['token' => $token, 'logo' => $img], function ($message) use ($user) {

                $message->to($user->email);

                $message->subject('Email Verification Mail');
            });
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function deactivateUser($user, $status){
       

        $properties = Property::where('active', true)->where('landlord_id', $user->id)->get();
       

        foreach ($properties as $property) {
            $property->active = $status;
            $property->save();
            $this->deactivateLeases($property, $status);
            
        }
        $user->active = $status;

        try {
           
            $user->save();
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }

    private function deactivateLeases($property, $status){
        $leaseAgreements = LeaseAgreements::where('active', true)->where('property_id', $property->id)->get();
        foreach ($leaseAgreements as $agreement) {
           $agreement->active = $status;
           $agreement->save();
        }
    }
}
