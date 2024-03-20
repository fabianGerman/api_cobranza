<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diferencia extends Model
{
    use HasFactory;

    protected $filiable=[
        'importe',
        'periodo',
        'fecha_pago',
        'id_afiliado'
    ];

    public function afiliado(){
        return $this->belongsTo('App\Models\Afiliado');
    }
}
