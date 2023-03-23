<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\LeaseAgreements;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Services\PropertyService;

use App\Models\Property;
use App\Models\RentTypeCatalog;
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
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
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
            'tenant_email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        $user = Auth::user();

        $property = Property::where('landlord_id', $user->id)->where('id', $request->get('property_id'))->first();

        if(!$property){
            return response()->json(['message' => 'No se encontró propiedad. Revise los datos ingresados e intente nuevamente']);
        }

        $tenant = new Tenants;
        $tenant->name = $request->get('tenant_name');
        $tenant->lastname = $request->get('tenant_lastname');
        $tenant->username = $request->get('tenant_username');
        $tenant->phone = $request->get('tenant_phone');
        $tenant->email = $request->get('tenant_email');
        $tenant->active = true;
        $tenant->user_creates = $user->id;

        try {
            $tenant->save();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 503);
        }

        $rentType = RentTypeCatalog::where('id', $request->get('rent_type_id'))->first();
        
        $lease = new LeaseAgreements;

        //$lease->scanned_contract
        $lease->tenant_id = $tenant->id;
        $lease->property_id = $request->get('property_id');
        $lease->rent_type_id = $rentType->id;
        $lease->payment_date = $request->get('payment_date');
        $lease->expiration_date = $request->get('expiration_date');
        $lease->price = $request->get('price');
        $lease->deposit = $request->get('deposit');
        $lease->duration = $rentType->value;
        $lease->user_creates = $user->id;
        
        try {
            $lease->save();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 503);
        }

       return response()->json(['lease' => $lease, 'tenant' => $tenant], 201);
    }
}
