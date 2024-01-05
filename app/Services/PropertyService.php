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

    public function generatePDFContract($lease, $tenantDocument){
        $logo_path = storage_path('img/header_logo_master.png'); 

        $landlordDocument = $this->documentToWords($lease->propertyId->landlordId->dui);
        $tenantDocument = $this->documentToWords($tenantDocument->document_number);
        $totalRentPrice = $this->rentValueToWords(($lease->price * $lease->duration));
        $rentPrice = $this->rentValueToWords($lease->price);
        
        $html = View::make('pdf.printed-contract', [
            'lease'=> $lease,
            'landlordDocument' => $landlordDocument,
            'tenantDocument' => $tenantDocument,
            'totalRentPrice' => $totalRentPrice,
            'rentPrice' => $rentPrice
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

    function documentToWords($document) {
        $words = [
            '0' => ' cero',
            '1' => ' uno',
            '2' => ' dos',
            '3' => ' tres',
            '4' => ' cuatro',
            '5' => ' cinco',
            '6' => ' seis',
            '7' => ' siete',
            '8' => ' ocho',
            '9' => ' nueve',
            '-' => ' guión',
        ];
    
        $result = '';
        
        // Iterate through each character in the input string
        for ($i = 0; $i < strlen($document); $i++) {
            $char = $document[$i];
    
            // Check if the character exists in the $words array
            if (isset($words[$char])) {
                $result .= $words[$char];
            } else {
                // If the character is not found in $words, you may want to handle it accordingly
                // For now, it just appends the character itself
                $result .= $char;
            }
        }
    
        return $result;
    }


    function rentValueToWords($number) {
        $units = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
        $teens = ['', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
        $tens = ['', 'diez', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
        $hundreds = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];
    
        
        if ($number == 0) {
            return 'cero';
        }
    
        $words = [];
    
        // Extract digits
        $unitsDigit = $number % 10;
        $tensDigit = ($number % 100 - $unitsDigit) / 10;
        $hundredsDigit = ($number % 1000 - $tensDigit * 10 - $unitsDigit) / 100;
        $thousandsDigit = ($number % 10000 - $hundredsDigit * 100 - $tensDigit * 10 - $unitsDigit) / 1000;

        
        // Process thousands
        if ($thousandsDigit > 0) {
            $words[] = $thousandsDigit > 1 ? $units[$thousandsDigit] . ' mil' : 'mil';
        }
        
        // Process hundreds
        if ($hundredsDigit > 0) {
            $words[] = $hundreds[$hundredsDigit];
        }
    
        // Process tens and units
        if ($tensDigit == 1) {
            // If it's a teen number
            $words[] = $teens[$unitsDigit];
        } else {
            // Otherwise, process tens and units separately
            if ($tensDigit > 1) {
                $words[] = $tens[$tensDigit];
            }
    
            if ($unitsDigit > 0) {
                $words[] = $units[$unitsDigit];
            }
        }
    
        // Combine the words and return the result
        return implode(' ', $words);
    }

}
