<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Xeilon\Afiliado_Controller;
use App\Http\Controllers\Xeilon\Plan_Controller;
use App\Http\Controllers\Local\Afiliado_Controller_Local;
use App\Http\Controllers\Datos\Datos_Controller_Afiliados;
use App\Http\Controllers\Datos\Datos_Controller_Empresas;
use App\Http\Controllers\Datos\Datos_Controller_Plan;
use App\Http\Controllers\Datos\Datos_Controller_Obra_Social;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * PRUEBA DE DATOS PROCESADOS Y CARGA A LA BASE DE DATOS DE COBRANZA
 */
Route::get('/afiliados/test',[Datos_Controller_Afiliados::class,'tabla_afiliados']);
Route::get('/empresas/test',[Datos_Controller_Empresas::class,'tabla_empresas']);
Route::get('/planes/test',[Datos_Controller_Plan::class,'tabla_plan']);
Route::get('/obrassociales/test',[Datos_Controller_Obra_Social::class,'tabla_obra_social']);


/*
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=cobranza
DB_USERNAME=postgresql
DB_PASSWORD=123456
*/