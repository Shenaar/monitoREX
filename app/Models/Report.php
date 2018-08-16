<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends AbstractModel
{
    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
