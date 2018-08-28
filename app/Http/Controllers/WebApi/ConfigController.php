<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\GetConfigRequest;
use App\Services\ConfigStatusService;

class ConfigController extends Controller
{
    /**
     * @param GetConfigRequest $request
     * @param ConfigStatusService $configStatusService
     *
     * @return array
     */
    public function view(GetConfigRequest $request, ConfigStatusService $configStatusService)
    {
        $keys = $request->get('keys', null);

        return $configStatusService->get($keys);
    }
}
