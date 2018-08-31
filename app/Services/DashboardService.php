<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ProjectRepository;

/**
 *
 */
class DashboardService
{
    /** @var  ProjectRepository */
    private $projectRepository;

    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param User $user
     *
     * @return \App\Models\Project[]
     */
    public function getForUser(User $user)
    {
        return $this
            ->projectRepository
            ->getAvailable($user);
    }
}
