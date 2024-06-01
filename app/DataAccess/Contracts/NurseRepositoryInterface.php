<?php

namespace App\DataAccess\Contracts;

use App\Models\Nurse;
use Illuminate\Database\Eloquent\Collection;

interface NurseRepositoryInterface
{
    public function getAll() : Collection;
    public function getAllWithUsers(): Collection;
    public function getById(int $id) : ?Nurse;
    public function getByUserId(int $userId): ?Nurse;
    public function getWithUser(int $id);
    public function store(Nurse $entity) : bool;
    public function update(array $data, int $id) : bool;
    public function delete(int $id) : bool;
}
