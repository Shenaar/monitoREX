<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\CreateProjectRequest;
use App\Http\Requests\WebApi\UpdateProjectRequest;
use App\Models\Project;
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
        return $service->create($request->user(), $request->validated());
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
    public function owned(Request $request)
    {
        return $request->user()->ownedProjects;
    }
}
