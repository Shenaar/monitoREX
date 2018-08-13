<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;
use App\Repositories\ProjectRepository;

/**
 *
 */
class ProjectService
{
    const DEFAULT_LENGTH = 32;

    /** @var ProjectRepository */
    private $projectRepository;

    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param int $length
     * @return string
     */
    public function generateApiKey(int $length = self::DEFAULT_LENGTH)
    {
        return str_random($length);
    }

    /**
     * @param User $user
     * @param array $data
     *
     * @return Project
     */
    public function create(User $user, array $data)
    {
        $project = new Project();
        $project->title = $data['title'];
        $project->domain = $data['domain'];
        $project->api_key = $this->generateApiKey();
        $project->user()->associate($user);

        $this->projectRepository->create($project);

        return $project;
    }

    /**
     * @param Project $project
     * @param array   $data
     *
     * @return Project
     */
    public function update(Project $project, array $data)
    {
        $project->title  = $data['title'];
        $project->domain = $data['domain'];

        $this->projectRepository->update($project);

        return $project;
    }
}
