<?php

use App\Http\Controllers\Advertisement\AdvertisementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');


Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [LoginController::class, 'create'])->middleware('checkBlockedRole')->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('checkBlockedRole')->middleware('guest');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['checkBlockedRole'])->group(function(){
	Route::get('/advertisements', [AdvertisementController::class, 'getAdvertisements'])->middleware('auth')->name('advertisements');
	Route::post('/advertisements', [AdvertisementController::class, 'getAdvertisementsWithCategory'])->middleware('auth')->name('getAdvertisementsWithCategory');

	Route::get('/advertisements/create', [AdvertisementController::class, 'getFormAdvertisement'])->middleware('auth')->name('getFormAdvertisement');
	Route::post('/advertisements/create', [AdvertisementController::class, 'createAdvertisement'])->middleware('auth')->name('createAdvertisement');

	Route::get('/panel', [AdminController::class, 'getAdminPanel'])->middleware('auth')->middleware('isAdmin')->name('getAdminPanel');
	Route::post('/panel', [AdminController::class, 'getInfo'])->middleware('auth')->middleware('isAdmin')->name('getInfo');
	Route::post('/panel/control/user', [AdminController::class, 'controlUser'])->middleware('auth')->middleware('isAdmin')->name('controlUser');

	Route::post('/panel/control/advertisement', [AdminController::class, 'controlAdvertisement'])->middleware('auth')->middleware('isAdmin')->name('controlAdvertisement');
	Route::post('/panel/control/advertisement/create', [AdminController::class, 'editAdvertisement'])->middleware('auth')->middleware('isAdmin')->name('editAdvertisement');
});

	

