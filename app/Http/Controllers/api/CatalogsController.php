<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Departamentos;
use App\Models\Distritos;
use App\Models\DocumentTypeCatalog;
use App\Models\Municipios;
use App\Models\PaymentClass;
use App\Models\PropertyType;
use App\Models\RentTypeCatalog;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class CatalogsController extends Controller{
    public function getRentTypeCatalog(Request $request){
        $rentTypes = RentTypeCatalog::where('active', true)->get();
        return response()->json($rentTypes, 200);
    }

    public function getPaymentTypeCatalog(Request $request){
        $paymentTypes = PaymentType::where('active', true)->get();
        return response()->json($paymentTypes, 200);
    }

    public function getDocumentTypeCatalog(Request $request){
        $documentTypes = DocumentTypeCatalog::where('active', true)->get();
        return response()->json($documentTypes, 200);
    }
    public function getPropertyTypeCatalog(Request $request){
        $propertyTypes = PropertyType::where('active', true)->get();
        return response()->json($propertyTypes, 200);
    }
    public function getPaymentClassCatalog(Request $request){
        $paymentClass = PaymentClass::where('active', true)->get();
        return response()->json($paymentClass, 200);
    }

    public function getDepartamentos(Request $request){
        $departamentos = Departamentos::where('active', true)->get();
        return response()->json($departamentos, 200);
    }
    public function getMunicipios(Request $request, $idDepartamento){
        $municipios = Municipios::with(['departamentoId'])->where('active', true)->where('departamento_id', $idDepartamento)->get();
        return response()->json($municipios, 200);
    }
    public function getDistritos(Request $request, $idMunicipio){
        $distritos = Distritos::with(['departamentoId', 'municipioId'])->where('municipio_id', $idMunicipio)->get();
        return response()->json($distritos, 200);
    }
}
