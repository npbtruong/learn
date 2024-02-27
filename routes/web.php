<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('admin',[AuthController::class, 'login_admin']);
Route::post('admin',[AuthController::class, 'auth_login_admin']);




Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('admin/admin/list', function () {
    return view('admin.admin.list');
});


Route::get('/', function () {
    return view('welcome');
});