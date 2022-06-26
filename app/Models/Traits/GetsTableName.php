<?php

namespace App\Models\Traits;

trait GetsTableName
{
    public static function getTableName()
    {
        return (new self())->getTable();
    }
}
