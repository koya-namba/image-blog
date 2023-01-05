<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TacticalBoardController;
use App\Http\Controllers\TweetController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);

Route::get('/item', [ItemController::class, 'index']);
Route::get('/item/create', [ItemController::class, 'create']);
Route::post('/item', [ItemController::class, 'store']);

Route::get('/tactical', [TacticalBoardController::class, 'index']);
Route::get('/tactical/create', [TacticalBoardController::class, 'create']);
Route::get('/tactical/{tactical_board}', [TacticalBoardController::class, 'show']);
Route::post('/tactical', [TacticalBoardController::class, 'store']);

Route::get('/tweets', [TweetController::class, 'index']);
Route::get('tweets/create', [TweetController::class, 'create']);
Route::post('/tweets', [TweetController::class, 'store_tweet']);
