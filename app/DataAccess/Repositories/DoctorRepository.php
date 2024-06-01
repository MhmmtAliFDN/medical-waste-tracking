<?php

namespace App\DataAccess\Repositories;

use App\DataAccess\Contracts\DoctorRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;

class DoctorRepository implements DoctorRepositoryInterface
{
    public function getAll(): Collection
    {
        return Doctor::get();
    }

    public function getAllWithUsers(): Collection
    {
        return Doctor::with('user')->get();
    }

    public function getById(int $id): ?Doctor
    {
        return Doctor::find($id);
    }

    public function getByUserId(int $userId): ?Doctor
    {
        return Doctor::where('user_id', $userId)->first();
    }

    public function getWithUser(int $id)
    {
        return Doctor::with('user')->find($id);
    }

    public function store(Doctor $entity): bool
    {
        return $entity->save();
    }

    public function update(array $data, int $id): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Doctor::destroy($id);
    }
}
