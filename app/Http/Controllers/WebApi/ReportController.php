<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Models\Project;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @param Project $project
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList(Project $project, Request $request)
    {
        return $project
            ->reports()
            ->latest()
            ->paginate($request->get('perPage', 10));
    }
}
