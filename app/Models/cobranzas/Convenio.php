<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;

    protected $filiable=[
        'resolucion',
        'descripcion',
        'inhabilitado'
    ];

    public function remuneracion(){
        return $this->belongsToMany('App\Models\Remuneracion');
    }
}
