<?php

use App\Http\Controllers\FallbackController;
use App\Http\Controllers\WebApi\Auth\LoginController;
use App\Http\Controllers\WebApi\Auth\RegisterController;
use App\Http\Controllers\WebApi\ConfigController;
use App\Http\Controllers\WebApi\ProjectController;
use App\Http\Controllers\WebApi\ReportController;
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

    $router->get('/available', ProjectController::action('available'))
        ->name('available')
    ;

    $router->get('/key', ProjectController::action('key'))
        ->name('key')
        ->can('update', 'project')
    ;

    $router->put('/{project}', ProjectController::action('update'))
        ->name('update')
        ->can('update', 'project')
    ;

    Route::prefix('/{project}/reports')->name('report.')->group(function (Router $router) {
        $router->get('/', ReportController::action('getList'))
            ->name('list')
            ->can('listReports', 'project');
        ;

        $router->get('/{report}', ReportController::action('view'))
            ->name('view')
            ->can('listReports', 'project');
        ;
    });
});

if (app()->isLocal()) {
    Route::middleware(['auth'])->prefix('/config')->name('config.')->group(function (Router $router) {
        $router->get('/', ConfigController::action('view'))
            ->name('view')
        ;
    });
}

Route::any('{all}', FallbackController::action('notFound'))
    ->where('all', '.*');;
