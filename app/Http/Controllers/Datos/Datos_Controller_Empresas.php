<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Xeilon\Empresa_Xeilon;
use App\Models\Cobranzas\Empresa;

class Datos_Controller_Empresas extends Controller
{
    public function tabla_empresas(){
        $cuit = "30-57637424-7";
        $periodo = "12/2023";
        $empresa=Empresa_Xeilon::search_empresa_by_cuit($cuit);
        $xeilon = Empresa_Xeilon::get_count_afiliados_inconsistencia_by_empresa($empresa->cuit,$empresa->idempresasj,$periodo);
        return response()->json($xeilon);
    }

    
}
