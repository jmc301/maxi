<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clientes', 'ClientesController@index')->name('listar_clientes');
//     ->middleware('auth');
Route::get('/titulos', 'TitulosController@index')->name('listar_titulos');
Route::get('/clientes/criar', 'ClientesController@create')
    ->name('form_criar_cliente');

Route::get('/titulos/criar', 'TitulosController@create')
    ->name('form_criar_titulo');
    
Route::post('/clientes/criar', 'ClientesController@store');
Route::post('/titulos/criar', 'TitulosController@store');

Route::post('/clientes/{id}/alterar', 'ClientesController@update')
->name('form_alterar_cliente');

Route::post('/clientes/{id}/alterar', 'ClientesController@update');
Route::post('/clientes/{id}/gravar', 'ClientesController@storeup');

Route::delete('/clientes/{id}', 'ClientesController@destroy');
Route::post('/clientes/{id}/editaNome', 'ClientesController@editaNome');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/entrar', 'EntrarController@index');

Route::get('/sair', function () {
//     \Illuminate\Support\Facades\Auth::logout();
    return redirect('/clientes');
});

Route::get('/buscarClientesEmJson', function() {
   return \App\Cliente::all();
});

Route::get('/maxi', 'ClientesController@index');

Route::get('/menu',  function() {
    return view ('menu');
});

Route::get('/', function() {
	return view ('welcome');
});

Route::get('/home',  function() {
        return view ('menu');
    });

Route::get('/teste', function() {
    return view ('layout');
});

