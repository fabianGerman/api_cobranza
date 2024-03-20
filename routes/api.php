<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Xeilon\Afiliado_Controller;
use App\Http\Controllers\Local\Afiliado_Controller_Local;
use App\Http\Controllers\Datos\Datos_Controller_Empresas;

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

Route::get('/afiliados/list',[Afiliado_Controller::class,'list_afiliados']);
Route::get('/afiliados/local/list',[Afiliado_Controller_Local::class,'list_afiliados']);
Route::get('/afiliados/test',[Datos_Controller::class,'tabla_afiliados']);

Route::get('/empresas/test',[Datos_Controller_Empresas::class,'tabla_empresas']);

/*
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=cobranza
DB_USERNAME=postgresql
DB_PASSWORD=123456
*/