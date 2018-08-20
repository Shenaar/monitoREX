<?php

namespace App\Broadcasting;

use App\Models\Project;
use App\Models\User;

class ProjectChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user, Project $project)
    {\Log::debug($user);\Log::debug($project);
        return $user->id === $project->user_id;
    }
}
