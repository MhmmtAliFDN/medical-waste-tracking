<?php

namespace App\DataAccess\Contracts;

use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

interface ReportRepositoryInterface
{
    public function getAll() : Collection;
    public function getAllWithAuthorizedOfficers(): Collection;
    public function getAllWithUsers(): Collection;
    public function getById(int $id) : ?Report;
    public function getByAuthorizedOfficerId(int $authorizedOfficerId): ?Report;
    public function getWithAuthorizedOfficer(int $id);
    public function store(Report $entity) : bool;
    public function update(array $data, int $id) : bool;
    public function delete(int $id) : bool;
}
