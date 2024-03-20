<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Xeilon\Afiliado_Xeilon;
use App\Models\Xeilon\Empresa_Xeilon;
use App\Models\Cobranzas\Afiliado;

class Afiliado_Controller extends Controller
{
    public function list_afiliados(){
        $xeilon = Afiliado_Xeilon::get_all_afiliados();
        $afiliados = $this->datos($xeilon);
        $this->cargar_datos($afiliados);
        return response()->json($afiliados);
    }

    public function datos($afiliados){
        foreach($afiliados as $afiliado){
           
            $activo = Afiliado_Xeilon::get_estado_actual($afiliado->id_afiliado_sj);
            $grupo_familiar = Afiliado_Xeilon::get_count_grupo_familiar($afiliado->cuil);
            $obra_social = Afiliado_Xeilon::get_obra_social($afiliado->id_afiliado_sj);
            $plan = Afiliado_Xeilon::get_plan($afiliado->id_afiliado_sj);
            $empresa = Empresa_Xeilon::get_empresa_by_afiliado($afiliado->id_afiliado_sj);
            $afiliado->activo = $activo->activo;
            $afiliado->grupo_familiar = $grupo_familiar;
            $afiliado->obra_social_id = $obra_social->idobrasocial;
            $afiliado->obra_social_nro = $obra_social->nroobrasocial;
            $afiliado->obra_social_razonsocial = $obra_social->razonsocial;
            $afiliado->obra_social_siglas = $obra_social->siglas;
            $afiliado->plan_id = $plan->idplan;
            $afiliado->plan_nombre = $plan->nombreplan;
            $afiliado->empresa_id = $empresa[0]->idempresasj;
            $afiliado->empresa_cuit = $empresa[0]->cuit;
            $afiliado->empresa_razon_social = $empresa[0]->razonsocial;
            $afiliado->empresa_fecha_inicio = $empresa[0]->fechadesde;
            $afiliado->empresa_fecha_hasta = $empresa[0]->fechahasta;
             
        }

        return $afiliados;
    }

    public function cargar_datos($afiliados){
        
        foreach($afiliados as $af){
            $auxiliar = new Afiliado();
            $auxiliar->id_afiliado = $af->id_afiliado;
            $auxiliar->id_afiliado_sj = $af->id_afiliado_sj;
            $auxiliar->id_empresa_sj = $af->empresa_id;
            $auxiliar->id_plan = $af->plan_id;
            $auxiliar->nro_afiliado = $af->nro_afiliado;
            $auxiliar->cuil = $af->cuil;
            $auxiliar->documento = $af->nro_documento;
            $auxiliar->ap_y_nom = $af->nombres;
            $auxiliar->grupo_familiar = $af->grupo_familiar;
            $auxiliar->monotributista = null;
            $auxiliar->fecha_ingreso = null;
            $auxiliar->fecha_inactivacion = null;
            $auxiliar->fecha_alta = null;
            $auxiliar->fecha_baja = null;
            $auxiliar->activo = $af->activo;
            $auxiliar->plan_vigente = $af->plan_vigente;
            $auxiliar->plan_actual = 0;
            $auxiliar->plan_calculado = 0;
            $auxiliar->save();
        }
    }


    
}
