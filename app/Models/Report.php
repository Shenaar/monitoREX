<?php

namespace App\Models;

use App\Events\ReportCreated;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends AbstractModel
{
    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ReportCreated::class,
    ];

    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
