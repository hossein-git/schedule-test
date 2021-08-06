<?php

namespace Modules\User\Models;

use Illuminate\Support\Facades\Log;
use Modules\Base\BaseModel;
use Modules\User\Database\Factories\ScheduleFactory;

class Schedule extends BaseModel
{
    const PENDING_STATUS = 0;
    const APPROVED_STATUS = 1;
    const DECLINED_STATUS = 2;

    protected static function newFactory()
    {
        return ScheduleFactory::new();
    }

    /**
     * get CSS class according the status
     */
    public function statusColor(): string
    {
        switch ($this->attributes['status']) {
            case self::PENDING_STATUS:
                return 'info';
            case self::APPROVED_STATUS:
                return 'success';
            case self::DECLINED_STATUS:
                return "danger";
            default:
                Log::error('unknown schedule status');
                return '';
        }
    }

    public function statusText(): string
    {
        switch ($this->attributes['status']) {
            case self::PENDING_STATUS:
                return 'pending';
            case self::APPROVED_STATUS:
                return 'approved';
            case self::DECLINED_STATUS:
                return "declined";
            default:
                Log::error('unknown schedule status');
                return '';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'name','email']);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }

}
