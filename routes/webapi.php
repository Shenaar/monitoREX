<?php

use App\Http\Controllers\WebApi\Auth\LoginController;
use App\Http\Controllers\WebApi\Auth\RegisterController;
use App\Http\Controllers\WebApi\ProjectController;
use App\Models\Project;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;


Route::prefix('/auth')->name('auth.')->group(function (Router $router) {

    $router->post('/register', RegisterController::action('register'))
        ->name('register');

    $router->post('/login', LoginController::action('login'))
        ->name('login');

    $router->get('/logout', LoginController::action('logout'))
        ->name('logout');

    $router->get('/current', LoginController::action('current'))
        ->name('current');
});


Route::middleware(['auth'])->prefix('/projects')->name('project.')->group(function (Router $router) {

    $router->post('/', ProjectController::action('create'))
        ->name('create')
        ->can('create', Project::class);
    ;

    $router->put('/{project}', ProjectController::action('update'))
        ->name('update')
        ->can('update', 'project')
    ;

    $router->get('/owned', ProjectController::action('owned'))
        ->name('owned')
    ;
});
