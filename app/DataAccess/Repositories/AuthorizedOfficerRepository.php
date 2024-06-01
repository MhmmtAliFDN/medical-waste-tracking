<?php

namespace App\DataAccess\Repositories;

use App\DataAccess\Contracts\AuthorizedOfficerRepositoryInterface;
use App\Models\AuthorizedOfficer;
use Illuminate\Database\Eloquent\Collection;

class AuthorizedOfficerRepository implements AuthorizedOfficerRepositoryInterface
{
    public function getAll(): Collection
    {
        return AuthorizedOfficer::get();
    }

    public function getAllWithUsers(): Collection
    {
        return AuthorizedOfficer::with('user')->get();
    }

    public function getById(int $id): ?AuthorizedOfficer
    {
        return AuthorizedOfficer::find($id);
    }

    public function getByUserId(int $userId): ?AuthorizedOfficer
    {
        return AuthorizedOfficer::where('user_id', $userId)->first();
    }

    public function getWithUser(int $id)
    {
        return AuthorizedOfficer::with('user')->find($id);
    }

    public function store(AuthorizedOfficer $entity): bool
    {
        return $entity->save();
    }

    public function update(array $data, int $id): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return AuthorizedOfficer::destroy($id);
    }
}
