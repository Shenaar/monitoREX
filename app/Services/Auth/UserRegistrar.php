<?php


namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Auth\Contracts\Registrar;
use App\Services\Auth\Exceptions\LoginExistsException;
use App\Services\UserService;

use Illuminate\Contracts\Hashing\Hasher;

/**
 *
 */
class UserRegistrar implements Registrar
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritdoc
     */
    public function getUserByLogin(string $login)
    {
        return $this->userRepository->getByLogin($login);
    }

    /**
     * @inheritdoc
     */
    public function register(string $login, string $password)
    {
        $existing = $this->getUserByLogin($login);

        if ($existing) {
            throw new LoginExistsException($login);
        }

        $user = new User();

        $user->email = $login;
        $user->password = $password;

        $this->userRepository->create($user);

        return $user;
    }

}
