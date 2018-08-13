<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Report[]
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
