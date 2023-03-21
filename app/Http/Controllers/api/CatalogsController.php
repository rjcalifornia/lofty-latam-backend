<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DocumentTypeCatalog;
use App\Models\RentTypeCatalog;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class CatalogsController extends Controller{
    public function getRentTypeCatalog(Request $request){
        $rentTypes = RentTypeCatalog::where('active', true)->get();
        return response()->json([$rentTypes, 200]);
    }

    public function getPaymentTypeCatalog(Request $request){
        $paymentTypes = PaymentType::where('active', true)->get();
        return response()->json([$paymentTypes, 200]);
    }

    public function getDocumentTypeCatalog(Request $request){
        $documentTypes = DocumentTypeCatalog::where('active', true)->get();
        return response()->json([$documentTypes, 200]);
    }
}
