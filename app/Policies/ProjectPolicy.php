<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  User  $user
     * @param  Project  $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        return $project->user_id === $user->id;
    }

    /**
     * @param User $user
     * @param Project $project
     *
     * @return bool
     */
    public function listReports(User $user, Project $project)
    {
        return $project->user->id === $user->id;
    }
}
