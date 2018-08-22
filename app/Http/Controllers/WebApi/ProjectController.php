<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\CreateProjectRequest;
use App\Http\Requests\WebApi\UpdateProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @param CreateProjectRequest $request
     * @param ProjectService $service
     *
     * @return Project
     */
    public function create(CreateProjectRequest $request, ProjectService $service)
    {
        return $service
            ->create($request->user(), $request->validated())
            ->makeVisible('api_key');
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
        return $service
            ->update($project, $request->validated());
    }

    /**
     * @return Project[]
     */
    public function available(Request $request, ProjectRepository $repository)
    {
        return $repository
            ->getAvailable($request->user());
    }
}
