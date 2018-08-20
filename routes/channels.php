<?php

use App\Broadcasting\ProjectChannel;

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('Project.{project}', ProjectChannel::class);
