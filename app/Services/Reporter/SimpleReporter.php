<?php

namespace App\Services\Reporter;

use App\Models\Project;
use App\Models\Report;
use App\Repositories\ReportRepository;

/**
 *
 */
class SimpleReporter implements Reporter
{
    /**
     * @var ReportRepository
     */
    private $reportRepository;

    /**
     * @param ReportRepository $reportRepository
     */
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * @inheritdoc
     */
    public function createReport(Project $project, array $data)
    {
        $report = new Report();

        $report->class = $data['class'];
        $report->file = $data['file'];
        $report->line = $data['line'];
        $report->message = $data['message'];
        $report->url = $data['url'];

        $report->trace = array_get($data, 'trace', null);
        $report->project()->associate($project);

        $this->reportRepository->create($report);

        return $report;
    }
}
