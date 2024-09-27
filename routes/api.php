<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

//use App\Models\Wallet;
//use Spatie\Permission\Contracts\Permission;
//use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['localization']], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Route::post('resetPassword', [PasswordController::class, 'resetPassword']);

    Route::group(['middleware' => ['jwt.verify']], function () {

        Route::get('get-all', [ProductController::class, 'index']);
        Route::post('logout', [AuthController::class, 'logout']);


        
        Route::group(['middleware' => ['hasRole:admin']], function () {
            Route::get('getAll', [AdminController::class, 'index']);
            Route::get('getProductsWithFavorites', [AdminController::class, 'getProductsWithFavorites']);
            Route::get('addPoint/{id}', [AdminController::class, 'addPoint']);
        });

        Route::group(['middleware' => ['hasRole:user']], function () {
            Route::get('addFavorite/{id}', [ProductController::class, 'addFavorite']);
            Route::get('deleteFavorite/{id}', [ProductController::class, 'destroy']);
        });
    });
});
