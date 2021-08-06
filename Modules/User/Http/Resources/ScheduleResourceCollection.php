<?php

namespace Modules\User\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\User\Models\Job;


class ScheduleResourceCollection extends ResourceCollection
{
    public $collects = ScheduleResource::class;


    public function toArray($request)
    {
        return parent::toArray($request);
    }


    public function with($request)
    {
        return [
            'jobs' => Job::query()->pluck('name','id'),
        ];
    }
}
