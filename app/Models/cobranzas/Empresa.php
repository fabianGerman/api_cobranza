<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $filiable=[
        'id_empresa_sj',
        'cuit',
        'razon_social',
        'cantidad_afiliados',
        'cantidad_titulares',
        'cantidad_inconsistencias',
        'cantidad_titulares_activos'
    ];

    public function afiliados(){
        return $this->belongsToMany('App\Models\Afiliado');
    }
}
