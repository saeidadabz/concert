<?php

use App\Http\Middleware\CheckAccessMiddleware;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('/users/',[\App\Http\Controllers\UserController::class,'index']);
Route::middleware('auth:sanctum')->group(function (){

    Route::delete('/logout',[\App\Http\Controllers\LoginController::class,'destroy']);

    Route::get('/users/{user}',[\App\Http\Controllers\UserController::class,'show']);


    Route::post('/categories',[\App\Http\Controllers\CategoryController::class,'store'])->middleware(CheckAccessMiddleware::class . ':create-category') ;
    Route::patch('/categories/{category}',[\App\Http\Controllers\CategoryController::class,'update']);
    Route::delete('/categories/{category}',[\App\Http\Controllers\CategoryController::class,'destroy']);

    Route::post('/artist',[\App\Http\Controllers\ArtistController::class,'store']);
    Route::patch('/artist/{artist}',[\App\Http\Controllers\ArtistController::class,'update']);
    Route::delete('artists/{artist}',[\App\Http\Controllers\ArtistController::class,'destroy']);

    Route::prefix('/roles')->group(function (){
        Route::get('/',[\App\Http\Controllers\RoleController::class,'index'])->middleware(CheckAccessMiddleware::class . ':read-role') ;
        Route::get('/{role}',[\App\Http\Controllers\RoleController::class,'show'])->middleware(CheckAccessMiddleware::class . ':read-role');
        Route::post('/store',[\App\Http\Controllers\RoleController::class,'store'])->middleware(CheckAccessMiddleware::class . ':create-role');
        Route::patch('/{role}',[\App\Http\Controllers\RoleController::class,'update'])->middleware(CheckAccessMiddleware::class . ':update-role');
        Route::delete('/{role}',[\App\Http\Controllers\RoleController::class,'destroy'])->middleware(CheckAccessMiddleware::class . ':delete-role');
    });


    Route::prefix('/venues')->group(function (){
        Route::get('/',[\App\Http\Controllers\VenueController::class,'index']);
        Route::get('/{venue}',[\App\Http\Controllers\VenueController::class,'show']);
        Route::post('/store',[\App\Http\Controllers\VenueController::class,'store']);


    });


});
Route::get('/artist',[\App\Http\Controllers\ArtistController::class,'index']);

Route::get('artists/{artist}',[\App\Http\Controllers\ArtistController::class,'show']);

Route::get('/categories',[\App\Http\Controllers\CategoryController::class,'index']);

Route::get('/categories/{category}',[\App\Http\Controllers\CategoryController::class,'show']);

Route::post('/register',[\App\Http\Controllers\RegisterController::class,'store']);
Route::post('/login',[\App\Http\Controllers\LoginController::class,'store']);
