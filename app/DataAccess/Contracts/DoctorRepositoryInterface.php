<?php

namespace App\DataAccess\Contracts;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;

interface DoctorRepositoryInterface
{
    public function getAll() : Collection;
    public function getAllWithUsers(): Collection;
    public function getById(int $id) : ?Doctor;
    public function getByUserId(int $userId): ?Doctor;
    public function getWithUser(int $id);
    public function store(Doctor $entity) : bool;
    public function update(array $data, int $id) : bool;
    public function delete(int $id) : bool;
}
