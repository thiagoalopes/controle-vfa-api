<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function(){

    Route::get('ordens-de-servicos', 'App\Http\Controllers\Api\V1\OrdemDeServicoController@index');

    Route::get('servidores', 'App\Http\Controllers\Api\V1\ServidorController@index');
    Route::post('servidores', 'App\Http\Controllers\Api\V1\ServidorController@store');
    Route::get('servidores/{id}', 'App\Http\Controllers\Api\V1\ServidorController@show')->where(['id'=>'^[0-9]+$'])->name('servidores.show');
    Route::put('servidores/{id}', 'App\Http\Controllers\Api\V1\ServidorController@update')->where(['id'=>'^[0-9]+$']);
    Route::delete('servidores/{id}', 'App\Http\Controllers\Api\V1\ServidorController@delete')->where(['id'=>'^[0-9]+$']);

    Route::get('ordens-de-servicos-servidores', 'App\Http\Controllers\Api\V1\OrdemDeServicoServidorController@index');

    Route::get('valores-pontos', 'App\Http\Controllers\Api\V1\ValorPontoController@index');

    Route::get('adiantamentos', 'App\Http\Controllers\Api\V1\AdiantamentoController@index');

    Route::get('parcelamentos', 'App\Http\Controllers\Api\V1\ParcelamentoController@index');

    Route::get('relatorio-vfas', 'App\Http\Controllers\Api\V1\RelatorioController@index');
    Route::post('relatorio-vfas/pesquisar', 'App\Http\Controllers\Api\V1\RelatorioController@search');

});

