<?php

namespace App\Http\Controllers\WebApi;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     * @param DashboardService $dashboardService
     *
     * @return \App\Models\Project[]
     */
    public function get(Request $request, DashboardService $dashboardService)
    {
        return $dashboardService
            ->getForUser($request->user());
    }
}
