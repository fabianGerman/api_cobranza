<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Afiliado extends Model
{
    use HasFactory;

    protected $filiable = [
        'id_afiliado',
        'id_afiliado_sj',
        'id_empresa_sj',
        'id_plan',
        'nro_afiliado',
        'cuil',
        'documento',
        'ap_y_nom',
        'grupo_familiar',
        'monotributista',
        'fecha_ingreso',
        'fecha_inactivacion',
        'fecha_alta',
        'fecha_baja',
        'activo',
        'plan_vigente',
        'plan_actual',
        'plan_calculado'
    ];

    public function diferencia(){
        return $this->hasMany('App\Models\Diferencia');
    }

    public function empresa(){
        return $this->belongsToMany('App\Models\Empresa');
    }

    public static function list_all_afiliados(){
        $result = DB::table('afiliados as af')
        ->get();
        return $result;
    }
}
