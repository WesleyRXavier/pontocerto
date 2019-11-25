<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

///minhas rotas
//Route::resource('acessos','Api\AcessoController');
//Route::resource('registros','Api\PontoController');

// rotas ponto
Route::namespace ('Api')->group(function () {
    Route::resource('acessos', 'AcessoController'); // toda a parte de crud do tipos de acesso , simples por isso nao esta separado

    Route::get('/registros', 'PontoController@todosRegistros')->name('listarTodos'); //lista todos os pontos
    Route::get('/registros/{usuario}', "PontoController@reg_usuario"); //lista todas os pontos do funcionario
    Route::post('/gravar', "PontoController@gravar"); //gravar um registro de ponto
    Route::get('/registros/{usuario}/{dtInicio}/{dtFim}', "PontoController@registroData"); // lista os registros de um usuario por periodo

});
