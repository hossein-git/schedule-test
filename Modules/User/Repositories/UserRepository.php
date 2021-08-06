<?php


namespace Modules\User\Repositories;


use Modules\Base\Repositories\BaseRepository;
use Modules\User\Models\User;


class UserRepository extends BaseRepository
{

    /**
     * @var string
     */
    protected $cacheKey = User::class;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return User::class;
    }


    /**
     * @return string
     */
    public function cacheKey(): string
    {
        return $this->cacheKey;
    }

}
