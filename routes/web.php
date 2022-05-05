<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CooperationController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\PMethodController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkingExperiencesController;
use App\Http\Controllers\Admin\WorkingHoursController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin.panel');
})->name('main');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/panel', [PanelController::class, 'index'])->name('panel.index');
    Route::patch('/posts/exist/{post}', [PostController::class, 'exist'])->name('posts.isExist');
    Route::resources([
        'users' => UserController::class,
        'posts' => PostController::class,
        'categories' => CategoryController::class,
        'workingexperiences' => WorkingExperiencesController::class,
        'cooperations' => CooperationController::class,
        'pmethods' => PMethodController::class,
        'workinghours' => WorkingHoursController::class,
    ]);
});

//Route::get('app', 'Api\v1\UploadController@update')->name('apk');
