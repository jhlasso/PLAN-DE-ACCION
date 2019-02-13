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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/{slug?}', 'HomeController@index')->name('home');

Route::resource('plandeaccion/plan','PlanDeAccionController');

Route::resource('plandeaccion/objetivos','ObjetivoController');

Route::resource('plandeaccion/responsables','ResponsableController');

Route::resource('plandeaccion/actividades','ActividadController');

Route::resource('plandeaccion/metas','MetaController');

Route::resource('plandeaccion/graficas','GraficaController');

Route::get('/login/google', 'SocialController@redirectToProvider');
Route::get('/login/google/callback', 'SocialController@handleProviderCallback');



