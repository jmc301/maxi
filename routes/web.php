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
Route::get('/series', 'SeriesController@index')
    ->name('listar_series')
    ->middleware('auth');
Route::get('/series/criar', 'SeriesController@create')
    ->name('form_criar_serie');
Route::post('/series/criar', 'SeriesController@store');
Route::delete('/series/{id}', 'SeriesController@destroy');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');

Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/entrar', 'EntrarController@index');

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/home');
});

Route::get('/buscarSeriesEmJson', function() {
   return \App\Serie::all();
});

Route::get('/ola', function () {
    echo "Olá Mundo!";
});

Route::get('/', function() {
	return view ('welcome');
});

Route::get('/filmes', 'FilmesController@listarFilmes');

Route::get('/series/teste', function() {
	return view ('teste');
});
Auth::routes();

