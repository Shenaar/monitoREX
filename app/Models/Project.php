<?php

namespace App\Models;

class Project extends AbstractModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
    public function user()
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
