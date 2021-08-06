<?php

namespace Modules\User\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;


class DashboardResourceCollection extends ResourceCollection
{
    public $collects = DashboardResource::class;


    public function toArray($request)
    {
        return parent::toArray($request);
    }


    public function with($request)
    {
        $week = $request->input('week') ?? 0;
        $month = $request->input('month') ?? now()->month;
        $year = $request->input('year') ?? now()->year;
        $dates = [];

        for ($i = 1; $i <= 7; ++$i) {
            $date = Carbon::createFromDate($year, $month)->weekday($i);
            $date->addWeeks($week);
            $dates[$date->dayName] = $date->toFormattedDateString();
        }

        return [
            'weeks' => $dates,
        ];
    }
}
