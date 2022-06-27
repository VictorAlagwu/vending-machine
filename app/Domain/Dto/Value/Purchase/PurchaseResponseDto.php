<?php

namespace App\Domain\Dto\Value\Purchase;


class PurchaseResponseDto
{
    public function __construct(
        public bool $status,
        public string $message,
        public ?object $data
    ) {
    }
}
