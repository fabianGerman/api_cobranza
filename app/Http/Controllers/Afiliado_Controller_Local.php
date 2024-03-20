<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cobranzas\Afiliado;
 
class Afiliado_Controller_Local extends Controller
{
    public function list_afiliados(){
        $afiliados = Afiliado::list_all_afiliados();
        return response()->json($afiliados);
    }
}
