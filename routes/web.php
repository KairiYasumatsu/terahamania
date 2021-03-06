<?php

use Illuminate\Support\Facades\Route;

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
    return view('top.top');
});

Route::get('/episodes', "EpisodeController@index")->name('episode.index');
Route::post('/episodes', "EpisodeController@store");
Route::get('/episodes/{episode}', 'EpisodeController@show')->name("episode.show");
