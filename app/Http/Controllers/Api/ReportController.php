<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateReportRequest;
use App\Services\Reporter\Reporter;

class ReportController extends Controller
{
    /**
     * @param CreateReportRequest $request
     * @param Reporter $reporter
     *
     * @return \App\Models\Report
     */
    public function create(CreateReportRequest $request, Reporter $reporter)
    {
        return $reporter->createReport($request->getProject(), $request->validated());
    }
}
