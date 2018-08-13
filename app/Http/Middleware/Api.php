<?php

namespace App\Http\Middleware;

use App\Repositories\ProjectRepository;

use Closure;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Api
{
    /** @var ProjectRepository */
    private $projectRepository;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $project = $this->projectRepository->getByKey($request->key);

        if (!$project) {
            throw new AccessDeniedHttpException();
        }

        $request->request->set('project', $project);

        return $next($request);
    }
}
