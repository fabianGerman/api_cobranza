<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remuneracion extends Model
{
    use HasFactory;

    protected $filiable=[
        'importe',
        'desde',
        'hasta'
    ];

    public function remuneracion_ddjj(){
        return $this->hasOne('App\Models\RemuneracionDDJJ');
    }

    public function convenios(){
        return $this->belongsToMany('App\Models\Convenio');
    }
}
