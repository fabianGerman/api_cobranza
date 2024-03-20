<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aporte extends Model
{ 
    use HasFactory;

    protected $filiable=[
        'id_aporte',
        'periodo_aporte',
        'mes_afip',
        'pago_por_oficina',
        'codigo_periodo_aporte',
        'codigo_mes_afip',
        'fecha_incorporacion',
        'cuit_empresa',
        'cuil_afiliado',
        'remuneracion',
        'aporte',
        'aporte',
        'contribucion',
        'subsidio',
        'monotributo',
        'total'
    ];
}
