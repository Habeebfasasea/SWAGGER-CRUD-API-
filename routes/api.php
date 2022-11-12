<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function(){

    // Public Routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);


    // Protected routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/userDetails', [AuthController::class, 'userDetails']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::resource('/documents', DocumentsController::class);
    });

});