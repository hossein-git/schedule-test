<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\Schedule;

class ScheduleFactory extends Factory
{

    protected $model = Schedule::class;


    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'date' => $this->faker->dateTimeBetween(now()->toDateString(), now()->addMonth()->toDateString()),
        ];
    }


}
