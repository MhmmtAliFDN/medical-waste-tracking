<?php

namespace App\DataAccess\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAll() : Collection;
    public function getById(int $id) : ?User;
    public function getDoesntHaveAnyRole(): Collection;
    public function assignRole(int $id, string $role): ?User;
    public function removeRole(int $id, string $role): ?User;
}
