<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends AbstractModel implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;

    protected $hidden = [
        'password',
    ];

    protected $guarded = [
        'id',
    ];

    /**
     * @inheritdoc
     */
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

    /**
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Project[]
     */
    public function ownedProjects()
    {
        return $this->hasMany(Project::class);
    }
}
