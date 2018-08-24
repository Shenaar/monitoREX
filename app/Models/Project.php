<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends AbstractModel
{
    /**
     * @var array
     */
    protected $hidden = [
        'api_key',
    ];

    /**
     * @return BelongsTo|User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany|Report[]
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
