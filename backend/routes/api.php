<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\Donnees\ProjetController;
use App\Http\Controllers\Donnees\GarantieController;
use App\Http\Controllers\Donnees\ElectriqueController;
use App\Http\Controllers\Donnees\TensionElectriqueController;
use App\Http\Controllers\BobinageController;
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

Route::get('/users', [UserController::class,'index']);
Route::post('/user/create', [UserController::class,'store']);
Route::put('/user/update/{id}', [UserController::class,'updatestore']);
Route::get('/user/{id}', [UserController::class,'show']);
Route::delete('/user/delete/{id}', [UserController::class,'delete']);

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


    });

Route::post("/register",[AuthController::class,'register']);
Route::post("/login",[AuthController::class,'index']);
Route::get('/electrique/{id}',[ElectriqueController::class ,'getoneelec']);
Route::get('/electrique',[ElectriqueController::class ,'index']);
Route::post('/tensionelectrique',[TensionElectriqueController::class ,'add']);
Route::post('/electrique/add',[ElectriqueController::class ,'store']);
Route::put('/electrique/edit/{id}',[ElectriqueController::class ,'edit']);
Route::delete('/electrique/delete/{id}',[ElectriqueController::class ,'delete']);
Route::put('/user/accept/{id}',[AuthController::class ,'accept']);
Route::delete('/user/decline/{id}',[AuthController::class ,'decline']);

Route::post('/forgot', [ForgotController::class,'forgot']);
Route::post('/reset', [ForgotController::class,'reset']);

Route::post('/garantie36',[GarantieController::class ,'garantie36']);

Route::put('/bobine/update/{id}',[BobinageController::class ,'updateBobinage']);
Route::delete('/bobine/delete/{id}',[BobinageController::class ,'deleteBobinage']);
Route::get('/bobines',[BobinageController::class ,'getAllBobine']);
Route::post('/bobine/add',[BobinageController::class ,'storeBobinage']);
Route::get('/bobine/{id}',[BobinageController::class ,'getOneBobine']);
Route::post('/garantie24',[GarantieController::class ,'garantie24']);
Route::put('/garantie/edit/{id}',[GarantieController::class ,'edit']);
