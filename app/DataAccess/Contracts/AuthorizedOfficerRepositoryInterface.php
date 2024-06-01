<?php

namespace App\DataAccess\Contracts;

use App\Models\AuthorizedOfficer;
use Illuminate\Database\Eloquent\Collection;

interface AuthorizedOfficerRepositoryInterface
{
    public function getAll() : Collection;
    public function getAllWithUsers(): Collection;
    public function getById(int $id) : ?AuthorizedOfficer;

    public function getByUserId(int $userId): ?AuthorizedOfficer;
    public function getWithUser(int $id);
    public function store(AuthorizedOfficer $entity) : bool;
    public function update(array $data, int $id) : bool;
    public function delete(int $id) : bool;
}
