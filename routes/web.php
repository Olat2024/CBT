<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserManagerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [IndexController::class, 'index']);
Route::prefix('/user_manager')->middleware('admin')->name('user_manager.')->group(function(){
    Route::get('/', [UserManagerController::class, 'index'])->name('index');
    Route::get('/get_all_users', [UserManagerController::class, 'getAllUsers'])->name('get_all_users');
    Route::get('/user_analytic', [UserManagerController::class, 'userAnalytic'])->name('user_analytic');
    Route::get('/get_all_roles', [UserManagerController::class, 'getAllRoles'])->name('get_all_roles');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});