<?php

namespace App\Http\Controllers\WebApi\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\LoginRequest;
use App\Models\User;
use App\Services\Auth\Contracts\Registrar;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @var Registrar
     */
    protected $registrar;

    /**
     * LoginController constructor.
     *
     * @param Registrar $registrar
     */
    public function __construct(Registrar $registrar)
    {
        $this->registrar = $registrar;
    }

    /**
     * @param LoginRequest $request
     * @param Hasher $hasher
     *
     * @return \App\Models\User
     */
    public function login(LoginRequest $request, Hasher $hasher)
    {
        $user = $this->registrar->getUserByLogin($request->get('login'));
        $password = $request->get('password');

        if (!$user || !$hasher->check($password, $user->getAuthPassword())) {
            throw new HttpResponseException(
                new JsonResponse([
                    'message' => 'Wrong credentials'
                ], Response::HTTP_UNPROCESSABLE_ENTITY)
            );
        }

        Auth::login($user);

        return $user;
    }

    /**
     *
     */
    public function logout()
    {
        Auth::logout();
    }

    /**
     * @return User|Authenticatable|null
     */
    public function current()
    {
        /** @var User $user */
        $user = Auth::user();
//$user = User::first();
        return $user;
    }
}
