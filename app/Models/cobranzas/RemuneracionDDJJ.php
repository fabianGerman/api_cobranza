<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemuneracionDDJJ extends Model
{
    use HasFactory;

    protected $filiable=[
        'fecha_incorporacion',
        'fecha_estado',
        'mes_impacto',
        'estado',
        'id_remuneracion'
    ];

    public function remuneracion(){
        return $this->belongsTo('App\Models\Remuneracion');
    }
}
