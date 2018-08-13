<?php

use App\Http\Controllers\WebApi\Auth\LoginController;
use App\Http\Controllers\WebApi\Auth\RegisterController;
use App\Http\Controllers\WebApi\ProjectController;

use Illuminate\Support\Facades\Route;

Route::get('/register/check_login', RegisterController::action('checkLogin'))->name('api.register.check_login');
Route::post('/register', RegisterController::action('register'))->name('api.register.register');

Route::post('/login', LoginController::action('login'))->name('api.login.login');
Route::get('/logout', LoginController::action('logout'))->name('api.login.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/auth/current', LoginController::action('current'))->name('api.auth.current');

    Route::post('/projects', ProjectController::action('create'))->name('api.project.create');
    Route::put('/projects/{project}', ProjectController::action('update'))->name('api.project.update');
});
