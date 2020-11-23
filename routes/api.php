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

    //Ordem de Serviço
    Route::get('ordens-de-servicos', 'App\Http\Controllers\Api\V1\OrdemDeServicoController@index');
    Route::post('ordens-de-servicos', 'App\Http\Controllers\Api\V1\OrdemDeServicoController@store');
    Route::get('ordens-de-servicos/{id}', 'App\Http\Controllers\Api\V1\OrdemDeServicoController@show')->where(['id'=>'^[0-9]+$'])->name('ordem_servico.show');;
    Route::put('ordens-de-servicos/{id}', 'App\Http\Controllers\Api\V1\OrdemDeServicoController@update')->where(['id'=>'^[0-9]+$']);
    Route::delete('ordens-de-servicos/{id}', 'App\Http\Controllers\Api\V1\OrdemDeServicoController@detroy')->where(['id'=>'^[0-9]+$']);
    

    //Ordem de serviço do servidor
    Route::get('ordens-de-servicos-servidores', 'App\Http\Controllers\Api\V1\OrdemDeServicoServidorController@index');
    Route::post('ordens-de-servicos-servidores', 'App\Http\Controllers\Api\V1\OrdemDeServicoServidorController@store');
    Route::get('ordens-de-servicos-servidores/{id}', 'App\Http\Controllers\Api\V1\OrdemDeServicoServidorController@show')->where(['id'=>'^[0-9]+$'])->name('ordem_servico_servidor.show');
    Route::put('ordens-de-servicos-servidores/{id}', 'App\Http\Controllers\Api\V1\OrdemDeServicoServidorController@update')->where(['id'=>'^[0-9]+$']);
    Route::delete('ordens-de-servicos-servidores/{id}', 'App\Http\Controllers\Api\V1\OrdemDeServicoServidorController@destroy')->where(['id'=>'^[0-9]+$']);
    

    //Servidores
    Route::get('servidores', 'App\Http\Controllers\Api\V1\ServidorController@index');
    Route::post('servidores', 'App\Http\Controllers\Api\V1\ServidorController@store');
    Route::get('servidores/{id}', 'App\Http\Controllers\Api\V1\ServidorController@show')->where(['id'=>'^[0-9]+$'])->name('servidores.show');
    Route::put('servidores/{id}', 'App\Http\Controllers\Api\V1\ServidorController@update')->where(['id'=>'^[0-9]+$']);
    Route::delete('servidores/{id}', 'App\Http\Controllers\Api\V1\ServidorController@destroy')->where(['id'=>'^[0-9]+$']);


    //Valor Ponto
    Route::get('valores-pontos', 'App\Http\Controllers\Api\V1\ValorPontoController@index');
    Route::post('valores-pontos', 'App\Http\Controllers\Api\V1\ValorPontoController@store');
    Route::get('valores-pontos/{id}', 'App\Http\Controllers\Api\V1\ValorPontoController@show')->where(['id'=>'^[0-9]+$'])->name('valor_ponto.show');
    Route::put('valores-pontos/{id}', 'App\Http\Controllers\Api\V1\ValorPontoController@update')->where(['id'=>'^[0-9]+$']);
    Route::delete('valores-pontos/{id}', 'App\Http\Controllers\Api\V1\ValorPontoController@destroy')->where(['id'=>'^[0-9]+$']);


    //Adiantamentos
    Route::get('adiantamentos', 'App\Http\Controllers\Api\V1\AdiantamentoController@index');
    Route::post('adiantamentos', 'App\Http\Controllers\Api\V1\AdiantamentoController@store');
    Route::get('adiantamentos/{id}', 'App\Http\Controllers\Api\V1\AdiantamentoController@show')->where(['id'=>'^[0-9]+$'])->name('adiantamento.show');
    Route::put('adiantamentos/{id}', 'App\Http\Controllers\Api\V1\AdiantamentoController@update')->where(['id'=>'^[0-9]+$']);
    Route::delete('adiantamentos/{id}', 'App\Http\Controllers\Api\V1\AdiantamentoController@destroy')->where(['id'=>'^[0-9]+$']);


    //Parcelamentos
    Route::get('parcelamentos', 'App\Http\Controllers\Api\V1\ParcelamentoController@index');
    Route::post('parcelamentos', 'App\Http\Controllers\Api\V1\ParcelamentoController@store');
    Route::get('parcelamentos/{id}', 'App\Http\Controllers\Api\V1\ParcelamentoController@show')->where(['id'=>'^[0-9]+$'])->name('parcelamento.show');
    Route::put('parcelamentos/{id}', 'App\Http\Controllers\Api\V1\ParcelamentoController@put')->where(['id'=>'^[0-9]+$']);
    Route::delete('parcelamentos/{id}', 'App\Http\Controllers\Api\V1\ParcelamentoController@destroy')->where(['id'=>'^[0-9]+$']);


    //Relatório de VFA
    Route::get('relatorio-vfas', 'App\Http\Controllers\Api\V1\RelatorioController@index');
    Route::get('relatorio-vfas/pesquisar', 'App\Http\Controllers\Api\V1\RelatorioController@search');

});

