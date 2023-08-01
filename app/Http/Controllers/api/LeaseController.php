<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Services\PropertyService;

use App\Models\LeaseAgreements;
use App\Models\Property;

class LeaseController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }
    
    public function updateLeaseDetails(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'rent_type_id' => 'required|integer',
            'payment_class_id' => 'required|integer',
            'payment_date' => 'required',
            'expiration_date' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'No se puede procesar la solicitud. Faltan campos'], 422);
        }

        $lease = LeaseAgreements::where('id',$id)->first();

        if(!$lease){
             return response()->json(['message' => 'No se ha encontrado contrato. Revise los datos e intente nuevamente'], 422);
        }
        $this->propertyService->updateLease($request, $lease);
    }

    public function listLeases(Request $request, $id){
        $user = Auth::user();
        $property = Property::where('id', $id)->where('active', true)->where('landlord_id', $user->id)->first();

        if(!$property){
            return response()->json(['message' => 'No se ha encontrado la propiedad solicitada. Verifique la información ingresada e intente nuevamente']);
        }

        $user = Auth::user();
        $leaseAgreements = LeaseAgreements::with(['tenantId', 'propertyId.landlordId', 'rentType'])->where('property_id', $property->id)
        ->get();

        return response()->json($leaseAgreements, 200);
    }

    public function viewLeaseDetails(Request $request, $id){
        $lease = LeaseAgreements::with(['tenantId', 'propertyId.landlordId', 'rentType', 'payments', 'payments.leaseId.propertyId.landlordId', 'payments.leaseId.tenantId', 'paymentClassId'])->find($id);
        if (!$lease) {
            return response()->json(['message' => 'No se encontró contrato de alquiler. Revise los datos ingresados e intente nuevamente']);
        }
        return response()->json($lease, 200);
    }

    public function terminateLease(Request $request, $id){
        $lease = LeaseAgreements::find($id);
        if (!$lease) {
            return response()->json(['message' => 'No se encontró contrato de alquiler. Revise los datos ingresados e intente nuevamente']);
        }
        $lease->active = false;
        $lease->save();
        return response()->json(204);
    }
}
