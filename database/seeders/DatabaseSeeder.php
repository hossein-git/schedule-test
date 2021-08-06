<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Models\Job;
use Modules\User\Models\Role;
use Modules\User\Models\Schedule;
use Modules\User\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('jobs')->truncate();
        DB::table('schedules')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->createWorker();
        $this->createAdmin();

        User::factory(10)->hasSchedules(8)->create();
        $sched = Schedule::all()->pluck('id', 'id')->toArray();
        Job::factory(10)->create()->each(function ($job) use ($sched) {
            $job->schedules()->attach(array_rand($sched));
        });
    }

    private function createWorker(): void
    {
        $worker = Role::query()->create(
            [
                'name' => Role::WORKER,
            ],
        );
        User::query()->create(
            [
                'name' => 'WORker',
                'role_id' => $worker->id,
                'email' => 'worker@t.co',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ]
        );
    }

    private function createAdmin(): void
    {
        $manager = Role::query()->create(
            [
                'name' => Role::Manager,
            ]
        );
        User::query()->create(
            [
                'name' => 'Hossein',
                'role_id' => $manager->id,
                'email' => 'hossein@t.co',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ]
        );
    }
}
