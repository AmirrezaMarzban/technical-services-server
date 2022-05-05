<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CooperationController;
use App\Http\Controllers\Api\PMethodController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkingExperiencesController;
use App\Http\Controllers\Api\WorkinghoursController;
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

Route::prefix('v1')->group(function () {
    Route::post('login', [UserController::class, 'loginOrRegister'])->name('user.loginOrRegister'); //user login or register
    Route::get('verify/{code}', [UserController::class, 'verify'])->name('sms.verification'); //send sms code 4 digits

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [UserController::class, 'single'])->name('user.profile');
        Route::post('/user', [UserController::class, 'update']);
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/categories/{category}', [CategoryController::class, 'single']);
        Route::post("/posts", [PostController::class, 'store']);
        Route::patch("/updatepost", [PostController::class, 'update']);
        Route::post("/deletepost", [PostController::class, 'delete']);
        Route::get("/posts", [PostController::class, 'index']);
        Route::get("/posts/{post}", [PostController::class, 'single']);
        Route::get("/provinces", [ProvinceController::class, 'index']);
        Route::get("/cooperations", [CooperationController::class, 'index']);
        Route::get("/search", [SearchController::class, 'index']);
        Route::get("/recent", [PostController::class, 'recent']);
        Route::post("/recent", [PostController::class, 'addToRecent']);
        Route::get("/pmethods", [PMethodController::class, 'index']);
        Route::get("/workinghours", [WorkinghoursController::class, 'index']);
        Route::get("/workingExperiences", [WorkingExperiencesController::class, 'index']);
        Route::get("/provinces/{province}", [ProvinceController::class, 'single']);
    });
});
