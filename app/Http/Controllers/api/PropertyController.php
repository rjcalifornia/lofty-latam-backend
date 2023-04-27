<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Services\PropertyService;

use App\Models\Property;
use App\Models\RentTypeCatalog;
use App\Models\LeaseAgreements;
use App\Models\Tenants;
use App\Models\PropertyPhoto;


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

    public function addPropertyPicture(Request $request){
        $validator = Validator::make($request->all(), [
            'property_id'=> 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        if ($request->filled('property_picture')) {
            $image = base64_decode($request->input('property_picture'));
            $extension = $request->extension;
            $imageName = $this->propertyService->storeImage($image, $extension, 'property_images');

            $propertyPhoto = new PropertyPhoto;
            $propertyPhoto->property_id = $request->property_id;
            $propertyPhoto->image_name = $imageName;
            $propertyPhoto->active = true;
            $propertyPhoto->user_creates =  auth()->user()->id;
            $propertyPhoto->save();
            
        }else{
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        return response()->json(['property_photo' => $propertyPhoto], 201);

    }
    
    public function listProperties(Request $request){
        // Get the logged-in user
        $user = Auth::user();

        // Retrieve the properties belonging to the logged-in user
        $properties = Property::with(['propertyPictures'])->where('landlord_id', $user->id)->get();

        // Return the properties as a JSON response
        return response()->json($properties, 200);
    }

    public function viewPropertyDetails(Request $request, $id){
        $property = Property::with(['landlordId', 'leases.tenantId', 'propertyPictures'])->where('id', $id)->where('active', true)->first();
        return response()->json($property, 200);
    }

    public function createLease(Request $request){
        $validator = Validator::make($request->all(),[
            'property_id' => 'required|integer',
            'rent_type_id' => 'required|integer',
            'contract_date' => 'required',
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

        $payment_date =  Carbon::parse($request->get('payment_date'));
        $expiration_date =  Carbon::parse($request->get('expiration_date'));
        $contract_date =  Carbon::parse($request->get('contract_date'));
        //$lease->scanned_contract
        $lease->tenant_id = $tenant->id;
        $lease->property_id = $request->get('property_id');
        $lease->rent_type_id = $rentType->id;
        $lease->contract_date = $contract_date->format('Y-m-d');
        $lease->payment_date = $payment_date->format('Y-m-d');
        $lease->expiration_date = $expiration_date->format('Y-m-d');
        $lease->price = $request->get('price');
        $lease->deposit = $request->get('deposit');
        $lease->duration = $rentType->value;
        $lease->user_creates = $user->id;
        $lease->active = true;
        
        try {
            $lease->save();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 503);
        }

       return response()->json(['lease' => $lease, 'tenant' => $tenant], 201);
    }

    public function listLeases(Request $request, $id){
        $user = Auth::user();
        $property = Property::where('id', $id)->where('active', true)->where('landlord_id', $user->id)->first();

        if(!$property){
            return response()->json(['message' => 'No se ha encontrado la propiedad solicitada. Verifique la información ingresada e intente nuevamente']);
        }

        $user = Auth::user();
        $leaseAgreements = LeaseAgreements::with(['tenantId', 'propertyId', 'rentType'])->where('property_id', $property->id)
        ->get();

        return response()->json($leaseAgreements, 200);
    }

    public function viewLeaseDetails(Request $request, $id){
        $lease = LeaseAgreements::with(['tenantId', 'propertyId', 'rentType', 'payments', 'payments.leaseId.propertyId.landlordId', 'payments.leaseId.tenantId'])->find($id);
        if (!$lease) {
            return response()->json(['message' => 'No se encontró contrato de alquiler. Revise los datos ingresados e intente nuevamente']);
        }
        return response()->json($lease, 200);
    }

    public function viewPropertyPicture(Request $request, $id){
        $propertyPicture = PropertyPhoto::where('id', $id)->where('active', true)->first();
        
        if(!$propertyPicture){
            return response()->json(['message'=> 'No se encontró foto, intente nuevamente más tarde.'], 404);
        }

        return response()->download(storage_path('/property_images_storage/'. $propertyPicture->image_name));

    }
}
