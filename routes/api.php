<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\MemberController;
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

//取得したエピソードidにひもづくメンバーを返すapi
Route::get('/episode/{id}', 'EpisodeController@getMemberByEpisode');

//最新のエピソード10件に対するpairを全て取得
Route::get('/latestpair', 'PairController@getLatestPair');

//全てのエピソードに対するpairを全て取得
Route::get('/allpairs', 'PairController@getAllPairs');

//vue側から投票データを取得
Route::post('/vote', 'PairController@updateCount');

//メンバーidに紐づく、メンバー取得
Route::get('/member/{id}', 'MemberController@getMemberbyId');