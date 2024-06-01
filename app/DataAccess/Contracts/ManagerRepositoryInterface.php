<?php

namespace App\DataAccess\Contracts;

use App\Models\Manager;
use Illuminate\Database\Eloquent\Collection;

interface ManagerRepositoryInterface
{
    public function getAll() : Collection;
    public function getAllWithUsers(): Collection;
    public function getById(int $id) : ?Manager;
    public function getByUserId(int $userId):? Manager;
    public function getWithUser(int $id);
    public function store(Manager $entity) : bool;
    public function update(array $data, int $id) : bool;
    public function delete(int $id) : bool;
}
