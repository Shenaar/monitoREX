<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Report;

/**
 *
 */
class ReportRepository extends EloquentRepository
{
    /**
     * @param Project $project
     * @param array $pagination
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Report[]
     */
    public function getLatest(Project $project, array $pagination)
    {
        return $project
            ->reports()
            ->latest()
            ->paginate(array_get($pagination, 'perPage', 10));
    }
}
