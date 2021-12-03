<?php

use App\Http\Controllers\EntretenimientoController;
use App\Http\Controllers\HobbieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PassportAuthController;

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

Route::post('login', [PassportAuthController::class, 'loginUser']);
Route::post('register', [PassportAuthController::class, 'registerUser']);

Route::middleware('auth:api')->group(function(){

    //Endpoints USER
    
    Route::post('logout', [PassportAuthController::class, 'logout']);

    Route::get('allusers', [UserController::class, 'showAllUsers']);
    Route::post('profile', [UserController::class, 'showProfile']);
    Route::put('update', [UserController::class, 'updateProfile']);

    //Endpoints MESSAGE

    Route::post('message', [MessageController::class, 'addMessage']);
    Route::get('allmessages', [MessageController::class, 'showAllMessages']);
    Route::post('profile', [MessageController::class, 'showMessagesProfile']);
    Route::delete('erase', [MessageController::class, 'deleteMessage']);

    //Endpoints HOBBIES

    Route::post('hobbie', [HobbieController::class, 'addHobbie']);

    //Endpoints ENTRETENIMIENTO

    Route::post('entretenerse', [EntretenimientoController::class, 'addAficion']);
    Route::post('aficiones', [EntretenimientoController::class, 'showAficionProfile']);

});



