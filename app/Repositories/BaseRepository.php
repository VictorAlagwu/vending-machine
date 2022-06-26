<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository as Repository;
use Prettus\Repository\Traits\CacheableRepository;

abstract class BaseRepository extends Repository implements CacheableInterface
{
    use CacheableRepository;

    public function findOne(array $where, $columns = ['*'])
    {
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->first($columns);

        $this->resetModel();

        return $model;
    }

    public function updateWhere(array $where, $updateArgs): bool
    {
        $this->applyScope();

        $this->applyConditions($where);

        $deleted = $this->model->update($updateArgs);
        $this->resetModel();

        return $deleted;
    }
}
