<?php

namespace App\Services\Reporter;

use App\Models\Project;
use App\Models\Report;

interface Reporter
{
    /**
     * @param Project $project
     * @param array $data
     *
     * @return Report
     */
    public function createReport(Project $project, array $data);
}
