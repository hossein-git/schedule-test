<?php


namespace Modules\User\Repositories;


use Modules\Base\Repositories\BaseRepository;
use Modules\User\Models\Job;
use Modules\User\Models\User;


class JobRepository extends BaseRepository
{

    /**
     * @var string
     */
    protected $cacheKey = Job::class;

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
        return Job::class;
    }


    /**
     * @return string
     */
    public function cacheKey(): string
    {
        return $this->cacheKey;
    }

}
