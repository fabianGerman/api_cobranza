<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $filiable=[
        'id_plan',
        'id_obra_social',
        'nombre_plan',
        'siglas',
        'percapita',
        'total'
    ];
}
