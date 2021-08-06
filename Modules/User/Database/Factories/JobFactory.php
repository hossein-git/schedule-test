<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Models\Job;
use Modules\User\Models\User;

class JobFactory extends Factory
{

    protected $model = Job::class;


    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
        ];
    }
}
