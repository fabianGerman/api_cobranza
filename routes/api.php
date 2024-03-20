<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Afiliado_Controller;
use App\Http\Controllers\Afiliado_Controller_Local;
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

