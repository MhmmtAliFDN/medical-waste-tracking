<?php

namespace App\DataAccess\Repositories;

use App\DataAccess\Contracts\NurseRepositoryInterface;
use App\Models\Nurse;
use Illuminate\Database\Eloquent\Collection;

class NurseRepository implements NurseRepositoryInterface
{
    public function getAll(): Collection
    {
        return Nurse::get();
    }

    public function getAllWithUsers(): Collection
    {
        return Nurse::with('user')->get();
    }

    public function getById(int $id): ?Nurse
    {
        return Nurse::find($id);
    }

    public function getByUserId(int $userId): ?Nurse
    {
        return Nurse::where('user_id', $userId)->first();
    }

    public function getWithUser(int $id)
    {
        return Nurse::with('user')->find($id);
    }

    public function store(Nurse $entity): bool
    {
        return $entity->save();
    }

    public function update(array $data, int $id): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Nurse::destroy($id);
    }
}
