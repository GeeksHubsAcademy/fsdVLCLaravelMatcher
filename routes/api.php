<?php

use App\Http\Controllers\EntretenimientoController;
use App\Http\Controllers\HobbieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

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

//Endpoints USER

Route::post('register', [UserController::class, 'registerUser']);
Route::get('allusers', [UserController::class, 'showAllUsers']);
Route::post('profile', [UserController::class, 'showProfile']);

//Endpoints MESSAGE

Route::post('message', [MessageController::class, 'addMessage']);
Route::get('allmessages', [MessageController::class, 'showAllMessages']);
Route::post('profile', [MessageController::class, 'showMessagesProfile']);

//Endpoints HOBBIES

Route::post('hobbie', [HobbieController::class, 'addHobbie']);

//Endpoints ENTRETENIMIENTO

Route::post('entretenerse', [EntretenimientoController::class, 'addAficion']);
Route::post('aficiones', [EntretenimientoController::class, 'showAficionProfile']);