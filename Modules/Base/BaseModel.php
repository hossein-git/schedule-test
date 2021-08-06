<?php

namespace Modules\Base;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function formatedCreatedAt()
    {
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->toDateTimeString();
    }
}
