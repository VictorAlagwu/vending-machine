<?php


namespace App\Domain\Traits;

trait Fillable
{
    public function filled(): array
    {
        filled(true);
        return array_filter($this->toArray(), 'filled');
    }
}
