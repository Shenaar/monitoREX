<?php

namespace App\Http\Controllers\WebApi\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\RegisterRequest;
use App\Services\Auth\Contracts\Registrar;
use App\Services\Auth\Exceptions\LoginExistsException;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class RegisterController extends Controller
{
    /**
     * @var Registrar
     */
    protected $registrar;

    /**
     * @param Registrar $registrar
     */
    public function __construct(Registrar $registrar)
    {
        $this->registrar = $registrar;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function checkLogin(Request $request)
    {
        $login = $request->get('login');

        $user = $this->registrar->getUserByLogin($login);

        return [
            'exists' => !is_null($user)
        ];
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \App\Models\User
     *
     * @throws HttpResponseException if the login exists
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->registrar->register(
                $request->get('login'),
                $request->get('password')
            );
        } catch (LoginExistsException $exception) {
            throw new HttpResponseException(
                new JsonResponse([
                    'message' => $exception->getMessage()
                ], Response::HTTP_UNPROCESSABLE_ENTITY)
            );
        }

        Auth::login($user);

        return $user;
    }

}
