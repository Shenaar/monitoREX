<?php

use App\Http\Controllers\Api\ReportController;

use Illuminate\Support\Facades\Route;

Route::post('/report', ReportController::action('create'))->name('report.create');
