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
Route::get('/titulos', 'TitulosController@index')->name('listar_titulos');
Route::get('/representantes', 'RepresentantesController@index')->name('listar_representantes');
Route::get('/posicao', 'TitulosController@posicao')->name('listar_posicao');

Route::get('/clientes/criar', 'ClientesController@create')
    ->name('form_criar_cliente');
Route::get('/titulos/criar', 'TitulosController@create')
    ->name('form_criar_titulo');
Route::get('/representantes/criar', 'RepresentantesController@create')
	->name('form_criar_representante');
    
Route::post('/clientes/criar', 'ClientesController@store');
Route::post('/titulos/criar', 'TitulosController@store');
Route::post('/representantes/criar', 'RepresentantesController@Store');

Route::post('/clientes/{id}/alterar', 'ClientesController@update')
	->name('form_alterar_cliente');
Route::post('/titulos/{id}/alterar', 'TitulosController@update')
	->name('form_alterar_titulo');

Route::post('/clientes/{id}/pesquisar', 'ClientesController@search')
    ->name('form_pesquisar_cliente');

Route::post('/clientes/{id}/alterar', 'ClientesController@update');
Route::post('/clientes/{id}/gravar', 'ClientesController@storeup');

Route::post('/titulos/{id}/alterar', 'TitulosController@update');
Route::post('/titulos/{id}/gravar', 'TitulosController@storeup');

Route::post('/representantes/{id}/alterar', 'RepresentantesController@update');
Route::post('/representantes/{id}/gravar', 'RepresentantesController@storeup');

Route::delete('/clientes/{id}', 'ClientesController@destroy');
Route::post('/titulos/{id}', 'TitulosController@destroy');
Route::post('/representantes/{id}', 'RepresentantesController@destroy');

Route::post('/clientes/{id}/editaNome', 'ClientesController@editaNome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/entrar', 'EntrarController@index');

Route::get('/sair', function () {
     \Illuminate\Support\Facades\Auth::logout();
    return redirect('/home');
});

Route::get('/buscarClientesEmJson', function() {
   return \App\Cliente::all();
});

Route::get('/maxi', 'ClientesController@index');

Route::get('/menu',  function() {
    return view ('menu');
})->middleware('auth');

Route::get('/', function() {
	return view ('welcome');
});

Route::get('/home',  function() {
        return view ('menu');
    });

Route::get('/teste', function() {
    return view ('layout');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
