<?php

namespace App\DataAccess\Repositories;

use App\DataAccess\Contracts\ReportRepositoryInterface;
use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

class ReportRepository implements ReportRepositoryInterface
{
    public function getAll(): Collection
    {
        return Report::get();
    }

    public function getAllWithAuthorizedOfficers(): Collection
    {
        return Report::with('authorizedOfficer')->get();
    }

    public function getAllWithUsers(): Collection
    {
        return Report::with('user')->get();
    }

    public function getById(int $id): ?Report
    {
        return Report::find($id);
    }
    public function getByAuthorizedOfficerId(int $authorizedOfficerId): ?Report
    {
        return Report::where('authorized_officer_id', $authorizedOfficerId)->first();
    }
    public function getWithAuthorizedOfficer(int $id)
    {
        return Report::with('authorizedOfficer')->find($id);
    }

    public function store(Report $entity): bool
    {
        return $entity->save();
    }

    public function update(array $data, int $id): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Report::destroy($id);
    }
}
