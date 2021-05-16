<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [PagesController::class, 'index']);

Route::get('/users', [UsersDashboardController::class, 'index']);
Route::get('/users/{id}/edit', [UsersDashboardController::class, 'edit']);
Route::match(['put', 'patch'], '/users/{id}/update', [UsersDashboardController::class, 'update']);

Route::get('email', [\App\Http\Controllers\EmailController::class, 'index']);



