<?php


namespace Modules\User\Repositories;


use Modules\Base\Repositories\BaseRepository;
use Modules\User\Models\Job;
use Modules\User\Models\Schedule;


class ScheduleRepository extends BaseRepository
{

    /**
     * @var string
     */
    protected $cacheKey = Schedule::class;

    /**
     * @var array
     */
    protected $fieldSearchable = [
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     */
    public function model(): string
    {
        return Schedule::class;
    }


    /**
     * @return string
     */
    public function cacheKey(): string
    {
        return $this->cacheKey;
    }

}
