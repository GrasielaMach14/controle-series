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
                        ->name('series_index');

Route::get('/series/criar', 'SeriesController@create')
                            ->name('form_criar_serie');

Route::post('/series/criar', 'SeriesController@store');

Route::post('/series/(id)/editarNome', 'SeriesController@editarNome');

Route::delete('/series/{id}', 'SeriesController@destroy');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');