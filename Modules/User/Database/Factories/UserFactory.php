<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Models\Role;
use Modules\User\Models\User;

class UserFactory extends Factory
{

    protected $model = User::class;


    public function definition()
    {
        $worker = Role::query()->firstWhere('name',Role::WORKER)->id;
        return [
            'name' => $this->faker->name(),
            'role_id' => $worker,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make(12345678),
            'remember_token' => Str::random(10),
        ];
    }


    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
