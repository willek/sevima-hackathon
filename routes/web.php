<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'auth/login', 301);

Route::group(['as' => 'auth.', 'prefix' => '/auth'], function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('postLogin');

    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['as' => 'qr.', 'prefix' => '/qr'], function () {
        Route::get('/generate/{id}', [QRController::class, 'generate'])->name('generate');
        Route::get('/scan', [QRController::class, 'scan'])->name('scan');
        Route::post('/scan', [QRController::class, 'scan_post'])->name('scan_post');

        Route::get('debug', [QRController::class, 'debug'])->name('debug');
    });

    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/users/{id}/report', [UserController::class, 'report'])->name('users.report');
        Route::resource('users', UserController::class);

        Route::resource('offices', OfficeController::class);
    });
});
