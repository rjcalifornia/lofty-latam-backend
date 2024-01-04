<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\View;


use App\Models\Property;
use App\Models\ContractTermination;

class PropertyService
{
    public function save($request)
    {

        $property = new Property;

        try {
            $property->name = $request->get('name');
            $property->address = $request->get('address');
            $property->bedrooms = $request->get('bedrooms');
            $property->beds = $request->get('beds');
            $property->bathrooms = $request->get('bathrooms');
            $property->has_wifi = $request->get('has_wifi');
            $property->has_ac = $request->get('has_ac');
            $property->has_kitchen = $request->get('has_kitchen');
            $property->has_dinning_room = $request->get('has_dinning_room');
            $property->has_sink = $request->get('has_sink');
            $property->has_fridge = $request->get('has_fridge');
            $property->has_tv = $request->get('has_tv');
            $property->has_furniture = $request->get('has_furniture');
            $property->has_garage = $request->get('has_garage');
            $property->landlord_id = auth()->user()->id; // Set the landlord_id to the ID of the authenticated user
            $property->user_creates = auth()->user()->id; // Set the user_creates to the ID of the authenticated user
            $property->active = true; // Set the active
            $property->property_type_id = $request->get('property_type_id');
            $property->save();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $property;
    }

    public function update($request, $property)
    {
        $user = Auth::user();
        try {
            $property->name = $request->get('name');
            $property->address = $request->get('address');
            $property->bedrooms = $request->get('bedrooms');
            $property->beds = $request->get('beds');
            $property->bathrooms = $request->get('bathrooms');
            $property->has_wifi = $request->get('has_wifi');
            $property->has_ac = $request->get('has_ac');
            $property->has_kitchen = $request->get('has_kitchen');
            $property->has_dinning_room = $request->get('has_dinning_room');
            $property->has_sink = $request->get('has_sink');
            $property->has_fridge = $request->get('has_fridge');
            $property->has_tv = $request->get('has_tv');
            $property->has_furniture = $request->get('has_furniture');
            $property->has_garage = $request->get('has_garage');
            $property->user_modifies = $user->id;
            $property->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function storeImage($image, $extension,  $disk)
    {
        $imageName = Str::uuid()->toString() . '.' . $extension;

        try {
            Storage::disk($disk)->put($imageName, $image);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $imageName;
    }

    public function updateLease($request, $lease){
        try {
            $lease->rent_type_id = $request->get('rent_type_id');
            $lease->payment_class_id = $request->get('payment_class_id');
            //$lease->contract_date = $request->get('contract_date');
           // $lease->payment_date = $request->get('payment_date');
            $lease->expiration_date = $request->get('expiration_date');
           // $lease->price = $request->get('price');
            $lease->user_modifies = auth()->user()->id;
            $lease->save();
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function terminateLease($request, $lease){
        $contractTermination = new ContractTermination;
        $terminationDate =  Carbon::now();
        try {
            
            $contractTermination->tenant_id = $lease->tenant_id;
            $contractTermination->lease_id = $lease->id;
            $contractTermination->comments = $request->get('comments');
            $contractTermination->termination_date = $terminationDate->format('Y-m-d');
            $contractTermination->user_creates = auth()->user()->id;
            $contractTermination->save();


            $lease->active = false;
            $lease->save();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function verifyProperty($propertyId){
        $user = Auth::user();
        $property = Property::where('id', $propertyId)->where('active', true)->where('landlord_id', $user->id)->first();
        return $property;
    }

    public function propertyStatus($property, $status){
        $user = Auth::user();
        try {
            $property->active = $status;
            $property->user_modifies = $user->id;
            $property->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generatePDFContract($lease){
        $logo_path = storage_path('img/header_logo_master.png'); 

        $html = View::make('pdf.printed-contract', [
            'lease'=> $lease,
            //'image' => $img
        ])->render();
        
        
        TCPDF::setMargins(14, 36, 14, true);
        TCPDF::AddPage();
        TCPDF::setImageScale(1);
        TCPDF::SetAutoPageBreak(false, 0);
        TCPDF::Image($logo_path, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
      //  TCPDF::Image("@$qr_raw", 80, 210, 0, 50, '', '', '', false, 400, '', false, false, 0);
        TCPDF::writeHTML($html, true, false, true, false, '');

        $uuid = Str::uuid(8)->toString();

        return TCPDF::Output($uuid . ".pdf", 'I');
    }

}
