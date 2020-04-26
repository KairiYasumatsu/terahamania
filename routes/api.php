<?php

use App\Http\Controllers\EpisodeController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//全てのエピソードを返すapi
Route::get('/episodes', function(Request $request){
    $episodes = App\Episode::all();
    return response()->json(['episodes' => $episodes]);
});

//取得したidにひもづくメンバーを返すapi
Route::get('/episode/{id}', 'EpisodeController@getMemberByEpisode');

//最新のエピソード10件に対するpairを全て取得
Route::get('/latestpair', 'PairController@getLatestPair');