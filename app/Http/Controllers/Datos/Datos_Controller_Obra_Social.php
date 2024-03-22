<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cobranzas\ObraSocial;
use App\Models\xeilon\Obra_Social_Xeilon;
class Datos_Controller_Obra_Social extends Controller
{
    public function tabla_obra_social(){
        $xeilon = Obra_Social_Xeilon::get_all_obras_sociales();
        $this->cargar_datos($xeilon);
        return response()->json($xeilon);
    }

    public function cargar_datos($obrassociales){
        foreach($obrassociales as $os){
            $cobranza = new ObraSocial();
            $cobranza->id_obra_social = $os->idobrasocial;
            $cobranza->nro_obra_social = $os->nroobrasocial;
            $cobranza->razon_social = $os->razonsocial;
            $cobranza->cuit = $os->cuit;
            $cobranza->siglas = $os->siglas;
            $cobranza->save();
        }
    }
}
