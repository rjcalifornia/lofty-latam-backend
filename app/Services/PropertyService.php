<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
            $lease->contract_date = $request->get('contract_date');
            $lease->payment_date = $request->get('payment_date');
            $lease->expiration_date = $request->get('expiration_date');
            $lease->price = $request->get('price');
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
            
            $contractTermination->tenant_id = auth()->user()->id;
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
}
