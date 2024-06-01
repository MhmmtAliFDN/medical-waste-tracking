<?php

namespace App\DataAccess\Repositories;

use App\DataAccess\Contracts\WasteCollectionStaffRepositoryInterface;
use App\Models\WasteCollectionStaff;
use Illuminate\Database\Eloquent\Collection;

class WasteCollectionStaffRepository implements WasteCollectionStaffRepositoryInterface
{
    public function getAll(): Collection
    {
        return WasteCollectionStaff::get();
    }

    public function getAllWithUsers(): Collection
    {
        return WasteCollectionStaff::with('user')->get();
    }

    public function getById(int $id): ?WasteCollectionStaff
    {
        return WasteCollectionStaff::find($id);
    }

    public function getByUserId(int $userId): ?WasteCollectionStaff
    {
        return WasteCollectionStaff::where('user_id', $userId)->first();
    }

    public function getWithUser(int $id)
    {
        return WasteCollectionStaff::with('user')->find($id);
    }

    public function store(WasteCollectionStaff $entity): bool
    {
        return $entity->save();
    }

    public function update(array $data, int $id): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return WasteCollectionStaff::destroy($id);
    }
}
