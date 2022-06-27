<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Dto\Request\User\CreateDto;
use App\Domain\Dto\Request\User\UpdateDto;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use Illuminate\Database\Eloquent\Collection;

final class UserService
{
    public function __construct(
        private IUserRepository $userRepository
    ) {
    }

    public function index(): Collection
    {
        return $this->userRepository->get();
    }

    public function create(CreateDto $dto): ?User
    {
        return $this->userRepository->create($dto->toArray());
    }

    public function show(string $uniqueId): ?User
    {
        return $this->userRepository->findOne([User::ID => $uniqueId]);
    }

    public function update(UpdateDto $dto, string $uniqueId): ?User
    {
        if ($uniqueId !== auth()->user()->id) {
            return null;
        }
        $user = $this->userRepository->findOne([User::ID => auth()->user()->id]);
        $this->userRepository
            ->update(
                $dto->filled(),
                $user->id
            );

        $user = $this->userRepository->findOne([User::ID => $uniqueId]);

        return $user;
    }

    public function destroy(string $uniqueId): int
    {
        if ($uniqueId !== auth()->user()->id) {
            return 0;
        }
        $user = $this->userRepository->findOne([User::ID => $uniqueId]);

        $user->products->each->delete();
        return $this->userRepository->deleteWhere([User::ID => $uniqueId]);
    }
}
