<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Report;
use App\Repositories\ReportRepository;

use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * @param Project $project
     * @param Report $report
     *
     * @return array
     */
    public function view(Project $project, Report $report)
    {
        if ($report->project_id !== $project->id) {
            throw new NotFoundHttpException('Report not found');
        }

        $report->project = $project;

        return [
            'report'  => $report,
        ];
    }
}
