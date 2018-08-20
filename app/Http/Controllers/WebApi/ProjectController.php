<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\CreateProjectRequest;
use App\Http\Requests\WebApi\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /** @var User */
    private $user;

    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @param CreateProjectRequest $request
     * @param ProjectService $service
     *
     * @return Project
     */
    public function create(CreateProjectRequest $request, ProjectService $service)
    {
        return $service->create($this->user, $request->validated());
    }

    /**
     * @param Project $project
     * @param UpdateProjectRequest $request
     * @param ProjectService $service
     *
     * @return Project
     */
    public function update(Project $project, UpdateProjectRequest $request, ProjectService $service)
    {
        return $service->update($project, $request->validated());
    }

    /**
     * @return Project[]
     */
    public function owned()
    {
        return $this->user->ownedProjects;
    }
}
