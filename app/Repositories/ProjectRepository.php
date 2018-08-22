<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\User;

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

    /**
     * @param User $user
     *
     * @return Project[]
     */
    public function getAvailable(User $user)
    {
        return $user->ownedProjects;
    }
}
