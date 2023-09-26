<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;

use App\Models\User;
use App\Models\UserVerify;
use App\Models\Roles;

class UsersController extends Controller{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
            $validator = Validator::make($request->all(),[
                'phone' => 'required|unique:users,phone',
            ],[
                'unique' => 'El teléfono ingresado ya está registrado en el sistema. Por favor, intente nuevamente',
            ]);
    
            if ($validator->fails()) {
                $message = implode(". ",$validator->messages()->all());
                return response()->json(['message'=> $message], 422);
            } 
            $user->phone = $request->get('phone');
            $user->save();
            return response()->json(204);
        }

        if ($request->has('email')) {
            $validator = Validator::make($request->all(),[
                'email' => 'required|email|unique:users,email',
            ],[
                'unique' => 'El :attribute ingresado ya está registrado en el sistema. Por favor, intente nuevamente',
            ]);
    
            if ($validator->fails()) {
                $message = implode(". ",$validator->messages()->all());
                return response()->json(['message'=> $message], 422);
            }  
       
            $user->email = $request->get('email');
            $user->save();
            return response()->json(204);
        }

        return response()->json(['message' => 'No se puede procesar la solicitud debido a que no ha llenado los campos requeridos'], 422);
    }

    public function userRegistration(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'username' => 'required||unique:users,username|max:255',
            'dui' => 'required|unique:users,dui|max:10',
            'email' => 'sometimes|nullable|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|string|min:6',
           
        ],[
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El :attribute ya está registrado en el sistema. Por favor, intente nuevamente',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
        ]);

        if ($validator->fails()) {
            $message = implode(". ",$validator->messages()->all());
            return response()->json(['message'=> $message], 422);
        }  

        $this->userService->createUser($request);

        $payload = $this->userService->jwtTokenRequest($request);
        $this->userService->sendVerificationEmail($payload['user']);
        return response()->json($payload,200);
    }

    public function resendValidationEmail(Request $request){
        $user = Auth::user();
        $this->userService->sendVerificationEmail($user);
        return response()->json(['message' => 'Correo de validación enviado correctamente'],200);
    }

    public function verifyAccount(Request $request, $token){
        $verifyUser = UserVerify::where('token', $token)->first();

        if(!$verifyUser){
            $data['verification'] = false;
   
        }else {
            $user = User::where('id', $verifyUser->user_id)->first();
            $user->is_email_verified = true;
            $user->save();
            $verifyUser->delete();
            $data['verification'] = true;
        }



        return view('email.validation-page',[
            'data'=>$data
        ]);

    }

    public function deactivateAccount(Request $request){
        $user = Auth::user();
        $this->userService->deactivateUser($user, false);
    }

}
