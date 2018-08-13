<?php

namespace App\Repositories;

use App\Models\Project;

/**
 *
 */
class ProjectRepository extends EloquentRepository
{
    /**
     * @param string $key
     *
     * @return Project|null
     */
    public function getByKey(string $key)
    {
        return $this->model
            ->where('api_key', $key)
            ->first();
    }
}
