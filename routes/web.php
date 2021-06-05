<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersDashboardController;
use Illuminate\Support\Facades\Auth;
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

//Enabled verification by passing in ['verify' => true] as a param
Auth::routes(['verify' => true]);

Route::get('/', [PagesController::class, 'home']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::post('dashboard/download-attachments', [DashboardController::class, 'downloadAttachments']);
    Route::post('dashboard/crop-images', [DashboardController::class, 'cropImages']);
    Route::post('dashboard/process-images', [DashboardController::class, 'processImages']);
});

Route::group(['middleware' => ['admin']], function () {
    Route::get('users', [UsersDashboardController::class, 'index']);
    Route::get('users/{id}/edit', [UsersDashboardController::class, 'edit']);
    Route::match(['put', 'patch'], '/users/{id}/update', [UsersDashboardController::class, 'update']);
});









