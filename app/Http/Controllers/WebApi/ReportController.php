<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Models\Project;

use App\Repositories\ReportRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @param Project $project
     * @param Request $request
     * @param ReportRepository $repository
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList(Project $project, Request $request, ReportRepository $repository)
    {
        return $repository
            ->getLatest($project, ['perPage' => $request->get('perPage', 10)]);
    }
}
