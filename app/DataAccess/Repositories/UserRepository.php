<?php

namespace App\DataAccess\Repositories;

use App\DataAccess\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): Collection
    {
        return User::get();
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function getDoesntHaveAnyRole(): Collection
    {
        return User::doesntHave('roles')->get();
    }

    public function assignRole(int $id, string $role): ?User
    {
        $user = $this->getById($id);
        if ($user != null) {
            return $user->assignRole($role);
        }
        return null;
    }

    public function removeRole(int $id, string $role): ?User
    {
        $user = $this->getById($id);
        if ($user != null) {
            return $user->removeRole($role);
        }
        return null;
    }
}
