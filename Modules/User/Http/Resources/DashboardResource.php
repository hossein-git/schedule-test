<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Handle first and default provider API
 */
class DashboardResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'schedules' => $this->schedulesPerWeek($request),
        ];
    }

}
