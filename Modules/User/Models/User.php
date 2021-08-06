<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\User\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function isManager()
    {
        return $this->role && $this->role->name === Role::Manager;
    }
}
