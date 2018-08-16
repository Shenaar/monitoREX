<?php

namespace App\Http\Middleware;

use App\Repositories\ProjectRepository;

use Closure;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Api
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->has('api_key')) {
            throw new AccessDeniedHttpException();
        }

        $project = $this->projectRepository->getByKey($request->api_key);

        if (!$project) {
            throw new AccessDeniedHttpException();
        }

        $request->request->set('project', $project);

        return $next($request);
    }
}
