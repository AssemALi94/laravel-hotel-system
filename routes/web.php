<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
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

Route::get('/', function () {return view('welcome');});
Route::get('/stripe', function () {return view('stripe');});

//Auth::routes();
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//for rooms
Route::resource('/rooms', RoomController::class);



Route::get('/user/admin', [UserController::class, 'showAdmin'])->name('user.admin');
Route::get('/user/manager', [UserController::class, 'showManager'])->name('user.manager');
Route::get('/user/receptionist', [UserController::class, 'showReceptionist'])->name('user.receptionist');
Route::get('/user/client', [UserController::class, 'showClient'])->name('user.client');


// for users
Route::resource('/user', UserController::class);


Route::resource('/floors', FloorController::class);


Route::resource('/reservation', ReservationController::class);

Route::resource('/service', ServiceController::class);



Route::get('/deletedusers', [UserController::class, 'showAllDeletedUsers'])->name('showAllDeletedUsers');
Route::get('/restoreuser/{id}', [UserController::class, 'restoreDeletedUser'])->name('restoreDeletedPost');
Route::get('/deletedusers/{id}', [UserController::class, 'deletePermanently'])->name('deletePermanently');





Route::get('/auth/github/redirect', [LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('/auth/github/callback', [LoginController::class, 'handleGithubCallback']);



Route::get('/auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);



Route::get('/', [PaymentController::class, 'index']);
Route::post('/transaction', [PaymentController::class, 'makePayment'])->name('make-payment');
