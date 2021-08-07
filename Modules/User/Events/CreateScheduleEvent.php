<?php

namespace Modules\User\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateScheduleEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array
     */
    private $schedule;

    public function __construct(array $schedule)
    {
        //
        $this->schedule = $schedule;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('new-schedules');
    }

    public function broadcastWith()
    {
        return [
            'schedule' => $this->schedule,
        ];
    }
}
