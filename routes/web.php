<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;

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



Route::get('/', [UserController::class, "loginPage"])->name('login');
Route::post('/login', [UserController::class, "userLogin"])->name('user.login');

Route::get('/register', [UserController::class, "registerPage"])->name('register');
Route::post('/register', [UserController::class, "userRegister"])->name('user.register');

Route::get('/dashboard', [UserController::class, "dashboardPage"])->name('dashboard')->middleware('guard');

Route::get('/logout', [UserController::class, "userLogout"])->name('logout');