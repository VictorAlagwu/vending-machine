<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\User\IUserRepository;

final class DepositService
{
    public function __construct(
        private IUserRepository $userRepository
    ) {
    }

    public function deposit(): ?User
    {
        return $this->userRepository->get();
    }

    public function reset(): ?User
    {
        $this->userRepository
            ->updateWhere(
                [User::ID => request()->user->id],
                [
                    User::DEPOSIT => 0
                ]
            );

        return $this->userRepository->findOne([User::ID => request()->user->id]);
    }
}
