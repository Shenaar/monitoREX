<?php

namespace App\Broadcasting;

use App\Models\Project;
use App\Models\User;

class ProjectChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Project $project
     *
     * @return bool
     */
    public function join(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }
}
