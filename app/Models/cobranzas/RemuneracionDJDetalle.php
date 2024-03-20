<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemuneracionDJDetalle extends Model
{
    use HasFactory;

    protected $filiable=[
        'id_remuneracion_dj',
        'linea',
        'codigo_periodo',
        'periodo',
        'remuneracion_procesada',
        'remuneracion_convenio',
        'remuneracion_valida',
        'aporte_esperado',
        'contribucion_esperado'
    ];
}
