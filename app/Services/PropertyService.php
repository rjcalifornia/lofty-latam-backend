<?php

namespace App\Services;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Property;

class PropertyService
{
    public function save($request){

        $property = new Property;
        $property->name = $request->get('name');
        $property->address = $request->get('address');
        $property->bedrooms = $request->get('bedrooms');
        $property->beds = $request->get('beds');
        $property->bathrooms = $request->get('bathrooms');
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

        return $property;
    }

    public function storeImage($image, $extension,  $disk){
        $imageName = Str::uuid()->toString() . '.' . $extension;

        try {
            Storage::disk($disk)->put($imageName, $image);
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return $imageName;
    }

}
