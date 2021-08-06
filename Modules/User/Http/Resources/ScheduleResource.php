<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Handle first and default provider API
 */
class ScheduleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'statusText' => $this->statusText(),
            'statusColor' => $this->statusColor(),
            'user' => $this->user,
            'jobs' => $this->jobs->pluck('name'),
            'date' => $this->date,
            'created_at' => $this->formatedCreatedAt(),
        ];
    }

}
