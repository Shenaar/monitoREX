<?php


namespace App\Services\Auth\Exceptions;

/**
 *
 */
class LoginExistsException extends \Exception
{

    /**
     * LoginExistsException constructor.
     */
    public function __construct(string $login)
    {
        $this->message = sprintf('User with credentials "%s" already exists', $login);
    }
}
