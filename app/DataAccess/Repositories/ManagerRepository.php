<?php

namespace App\DataAccess\Repositories;

use App\DataAccess\Contracts\ManagerRepositoryInterface;
use App\Models\Manager;
use Illuminate\Database\Eloquent\Collection;

class ManagerRepository implements ManagerRepositoryInterface
{
    public function getAll(): Collection
    {
        return Manager::get();
    }

    public function getAllWithUsers(): Collection
    {
        return Manager::with('user')->get();
    }

    public function getById(int $id): ?Manager
    {
        return Manager::find($id);
    }

    public function getByUserId(int $userId): ?Manager
    {
        return Manager::where('user_id', $userId)->first();
    }

    public function getWithUser(int $id)
    {
        return Manager::with('user')->find($id);
    }

    public function store(Manager $entity): bool
    {
        return $entity->save();
    }

    public function update(array $data, int $id): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Manager::destroy($id);
    }
}
