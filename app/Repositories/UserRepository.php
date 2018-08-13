<?php

namespace App\Repositories;

use App\Models\User;

/**
 *
 */
class UserRepository extends EloquentRepository
{
    /**
     * @param string $login
     *
     * @return User
     */
    public function getByLogin(string $login)
    {
        $query = $this->model->newQuery();
        $query->where('email', $login);

        return $query->first();
    }
}
