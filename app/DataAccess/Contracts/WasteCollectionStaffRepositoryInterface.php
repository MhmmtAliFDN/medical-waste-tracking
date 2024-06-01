<?php

namespace App\DataAccess\Contracts;

use App\Models\WasteCollectionStaff;
use Illuminate\Database\Eloquent\Collection;

interface WasteCollectionStaffRepositoryInterface
{
    public function getAll() : Collection;
    public function getAllWithUsers(): Collection;
    public function getById(int $id) : ?WasteCollectionStaff;
    public function getByUserId(int $userId): ?WasteCollectionStaff;
    public function getWithUser(int $id);
    public function store(WasteCollectionStaff $entity) : bool;
    public function update(array $data, int $id) : bool;
    public function delete(int $id) : bool;
}
