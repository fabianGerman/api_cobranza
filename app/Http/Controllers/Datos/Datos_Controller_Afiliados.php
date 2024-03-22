<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Xeilon\Afiliado_Xeilon;
use App\Models\Xeilon\Empresa_Xeilon;
use App\Models\Cobranzas\Afiliado;
use App\Models\Cobranzas\Plan;

class Datos_Controller_Afiliados extends Controller
{
    public function tabla_afiliados(){
        $xeilon = Afiliado_Xeilon::get_all_afiliados();
        $afiliados = $this->procesar_datos_afiliados($xeilon);
        
        //$this->cargar_datos_afiliados($afiliados);
        $mensaje = "prueba realizada";
        return response()->json($mensaje);
    }

    public function procesar_datos_afiliados($afiliados){
        
        foreach($afiliados as $afiliado){
           
            $activo = Afiliado_Xeilon::get_estado_actual($afiliado->id_afiliado_sj);
            $grupo_familiar = Afiliado_Xeilon::get_count_grupo_familiar($afiliado->cuil);
            $obra_social = Afiliado_Xeilon::get_obra_social($afiliado->id_afiliado_sj);
            $plan = Afiliado_Xeilon::get_plan($afiliado->id_afiliado_sj);
            $empresa = Empresa_Xeilon::get_empresa_by_afiliado($afiliado->id_afiliado_sj);
            $fecha = Afiliado_Xeilon::get_fecha_ingreso_egreso($afiliado->id_afiliado_sj);
            
            if ($obra_social != null) {
                $afiliado->obra_social_id = $obra_social->idobrasocial;
                $afiliado->obra_social_nro = $obra_social->nroobrasocial;
                $afiliado->obra_social_razonsocial = $obra_social->razonsocial;
                $afiliado->obra_social_siglas = $obra_social->siglas;
                
            } else {
                $afiliado->obra_social_id = null;
                $afiliado->obra_social_nro = null;
                $afiliado->obras_ocial_razonsocial = null;
                $afiliado->obra_social_siglas = null;
            }

            if ($plan != null) {
                $afiliado->plan_id = $plan->idplan;
                $afiliado->plan_nombre = $plan->nombreplan;

                $percapita = Plan::get_plan($afiliado->plan_id);
            
                $afiliado->plan_calculado = $percapita;
            } else {
                $afiliado->plan_id = 0;
                $afiliado->plan_nombre = null;
            }
            if (count($empresa)) {
                $afiliado->empresa_id = $empresa[0]->idempresasj;
            } else {
                $afiliado->empresa_id = null;
            }

            $planes = Plan::get_all_planes($afiliado->plan_id);

            $afiliado->activo = $activo->activo;
            $afiliado->grupo_familiar = $grupo_familiar;
            $afiliado->fecha_activacion = $fecha->fechaactivacion;
            $afiliado->fecha_inactivacion = $fecha->fechainactivacion;
        }
     
        return $afiliados;
    }

    public function  cargar_datos_afiliados($afiliados){
        
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
            $auxiliar->monotributista = $af->monotributista;
            $auxiliar->fecha_ingreso = $af->fecha_activacion;
            $auxiliar->fecha_inactivacion = $af->fecha_inactivacion;
            $auxiliar->activo = $af->activo;
            $auxiliar->plan_vigente = $af->plan_vigente;
            $auxiliar->plan_actual = 0;
            $auxiliar->plan_calculado = 0;
            $auxiliar->baja = $af->baja;
            $auxiliar->despedido = $af->despedido;
            $auxiliar->save();
        }
    }  
}
