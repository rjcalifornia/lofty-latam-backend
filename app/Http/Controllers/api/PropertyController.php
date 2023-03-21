<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Services\PropertyService;

use App\Models\Property;
use App\Models\Tenants;


class PropertyController extends Controller{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'bedrooms' => 'required|integer',
            'beds' => 'required|integer',
            'bathrooms' => 'required|integer',
            'has_ac' => 'boolean',
            'has_kitchen' => 'boolean',
            'has_dinning_room' => 'boolean',
            'has_sink' => 'boolean',
            'has_fridge' => 'boolean',
            'has_tv' => 'boolean',
            'has_furniture' => 'boolean',
            'has_garage' => 'boolean',
            'landlord_id' => 'required|integer',
            'activo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['mensaje' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }
        
        $property = $this->propertyService->save($request);

        return response()->json($property, 201);

        
    }
    
    public function listProperties(Request $request){
        // Get the logged-in user
        $user = Auth::user();

        // Retrieve the properties belonging to the logged-in user
        $properties = Property::where('landlord_id', $user->id)->get();

        // Return the properties as a JSON response
        return response()->json($properties, 200);
    }

    public function createLease(Request $request){
        $validator = Validator::make($request->all(),[
            'property_id' => 'required',
            'rent_type_id' => 'required',
            'payment_date' => 'required',
            'expiration_date' => 'required',
            'price' => 'required',
            'deposit' => 'required',
            'tenant_name' => 'required|string',
            'tenant_lastname' => 'required|string',
            'tenant_username' => 'required|string',
            'tenant_phone' => 'required|string',
            'tenant_email' => 'required|string|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['mensaje' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        $user = Auth::user();

        $property = Property::where('landlord_id', $user->id)->where('id', $request->get('property_id'))->first();

        if(!$property){
            return response()->json(['mensaje' => 'No se encontró propiedad. Revise los datos ingresados e intente nuevamente']);
        }

        $tenant = new Tenants;
        $tenant->name = $request->get('name');
        $tenant->lastname = $request->get('lastname');
        $tenant->username = $request->get('username');
        $tenant->phone = $request->get('phone');
        $tenant->email = $request->get('email');
        $tenant->active = $request->get('active');
        $tenant->user_creates = $user->id;
        $tenant->save();

       // return response()->json($tenant, 201);
    }
}
