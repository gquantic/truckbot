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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('bot/send/{chatId}/{message}', 'App\Http\Controllers\Linguist\TypeController@sendMessage');
Route::resource('chats', 'App\Http\Controllers\Api\ChatController');

Route::post('bot/type', 'App\Http\Controllers\Linguist\TypeController@handle');

Route::post('bot/send', 'App\Http\Controllers\Linguist\TypeController@sendMessage');
