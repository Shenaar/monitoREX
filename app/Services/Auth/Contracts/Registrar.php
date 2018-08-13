<?php


namespace App\Services\Auth\Contracts;

use App\Models\User;
use App\Services\Auth\Exceptions\LoginExistsException;

interface Registrar
{
    /**
     * Returns a User by login
     *
     * @param string $login
     *
     * @return User
     */
    public function getUserByLogin(string $login);

    /**
     * Registers a User
     *
     * @param string $login
     * @param string $password
     *
     * @return User
     *
     * @throws LoginExistsException when the login already exists
     */
    public function register(string $login, string $password);
}
