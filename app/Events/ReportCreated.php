<?php

namespace App\Events;

use App\Models\Report;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReportCreated implements ShouldBroadcast
{
    /**
     * @var Report
     */
    public $report;

    /**
     * ReportCreated constructor.
     * @param Report $report
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Project.' . $this->report->project_id);
    }
}
