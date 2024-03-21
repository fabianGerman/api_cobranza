<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use App\Models\Cobranzas\Plan;
use App\Models\Xeilon\Plan_Xeilon;
use Illuminate\Http\Request;

class Datos_Controller_Plan extends Controller
{
    public function tabla_plan(){
        $xeilon = Plan_Xeilon::get_all_planes();
        $planes = $this->procesar_datos($xeilon);
        //dd($planes);
        $this->cargar_datos($planes);
        
        return response()->json("prueba realizada");
    }

    public function cargar_datos($planes){
        foreach($planes as $plan){
            $plan_cobranza = new Plan();
            $plan_cobranza->id_plan = $plan->idplan;
            $plan_cobranza->id_obra_social = $plan->idobrasocial;
            $plan_cobranza->nombre_plan = $plan->nombreplan;
            $plan_cobranza->siglas = null;
            
            $plan_cobranza->percapita = $plan->percapita;
            $plan_cobranza->total = $plan->precio;
            $plan_cobranza->save();
            
        }
    }

    public function procesar_datos($planes){

        foreach($planes as $plan){
            $pmo = Plan::array_pmo($plan->idplan);
            $pc = Plan::array_pc($plan->idplan);
            $pe = Plan::array_pe($plan->idplan);
            $pp = Plan::array_pp($plan->idplan);
            $po = Plan::array_po($plan->idplan);
            if($pmo != null){
                $plan->percapita = $pmo[0];
                $plan->precio = $pmo[1];
            }
            if($pc != null){
                $plan->percapita = $pc[0];
                $plan->precio = $pc[1];
            }
            if($pe != null){
                $plan->percapita = $pe[0];
                $plan->precio = $pe[1];
            }
            if($pp != null){
                $plan->percapita = $pp[0];
                $plan->precio = $pp[1];
            }
            if($po != null){
                $plan->percapita = $po[0];
                $plan->precio = $po[1];
            } 
        }

        return $planes;

    }
}
