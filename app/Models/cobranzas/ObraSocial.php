<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraSocial extends Model
{
    use HasFactory;

    protected $filiable=[
        'id_obra_social'.
        'nro_obrä_social',
        'cuit',
        'razon_social',
        'siglas'
    ];
}
