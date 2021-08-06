<?php

namespace Modules\User\Models;

use Carbon\Carbon;
use Modules\Base\BaseModel;
use Modules\User\Database\Factories\JobFactory;

class Job extends BaseModel
{

    protected static function newFactory()
    {
        return JobFactory::new();
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }

    public function approvedSchedules()
    {
        return $this->belongsToMany(Schedule::class)
            ->select(['id', 'status', 'name', 'date'])
            ->where('status', Schedule::APPROVED_STATUS);
    }

    public function schedulesPerWeek($request)
    {
        $week = $request->input('week') ?? 0;
        $month = $request->input('month') ?? now()->month;
        $year = $request->input('year') ?? now()->year;
        $result = [];

        $rows = $this->approvedSchedules;
        for ($i = 1; $i <= 7; ++$i) {
            $date = Carbon::createFromDate($year, $month)->weekday($i);
            $date->addWeeks($week);
            $result[] = $rows->firstWhere('date', $date->toDateString()) ?? '-';
        }
        return $result;
    }
}
