<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjetController;
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

Route::get('/users', UserController::class.'@index');
Route::post('/user/create', UserController::class.'@store')->name('user.store');
Route::put('/user/update/{id}', UserController::class.'@updatesore')->name('user.updatestore');
Route::get('/user/{id}', UserController::class.'@show')->name('user.show');
Route::delete('/user/delete/{id}', UserController::class.'@delete')->name('user.delete');

Route::get('/projets',[ProjetController::class ,'getProjets']);
Route::get('/projets/search/{query}',[ProjetController::class ,'getsearch']);
Route::get('/projets/pagination',[ProjetController::class ,'paginateProjets']);
Route::post('/projets/create',[ProjetController::class ,'storeProjet']);
Route::get('/projets/{id}', [ProjetController::class ,'showProjet']);
Route::put('/projets/edit/{id}', [ProjetController::class ,'editProjet']);
Route::delete('/projets/delete/{id}', [ProjetController::class ,'deleteProjet']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    // Route::get('/projets',[ProjetController::class ,'getProjets']);
    Route::post('/logout',[AuthController::class ,'logout']);
    Route::get('/users', UserController::class.'@index');
    Route::post('/user/create', UserController::class.'@store');
    Route::put('/user/update/{id}', UserController::class.'@updatesore');
    Route::get('/user/{id}', UserController::class.'@show');
    Route::get('/user/delete/{id}', UserController::class.'@delete');

    });

Route::post("/register",[AuthController::class,'register']);
Route::post("/login",[AuthController::class,'index']);
