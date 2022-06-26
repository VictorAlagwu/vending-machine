<?php
namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface IBaseRepository extends RepositoryInterface
{
     /**
     * Find first model where conditions are met
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findOne(array $where, $columns = ['*']);

    /**
     * Update a entity in repository by where clause
     *
     * @param array $updateArgs
     * @param array $where
     * @return bool
     * @throws RepositoryException
     */
    public function updateWhere(array $where, $updateArgs): bool;
}