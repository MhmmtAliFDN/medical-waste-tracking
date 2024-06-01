<?php

namespace App\DataAccess\Contracts;

use App\Models\MedicalWaste;
use Illuminate\Database\Eloquent\Collection;

interface MedicalWasteRepositoryInterface
{
    public function getAll(): Collection;
    public function getAllWithUsers(): Collection;
    public function getAllWithUsersInDateRange($startDate, $endDate): Collection;
    public function getById(int $id): ?MedicalWaste;
    public function getWithUser(int $id);
    public function getTotalUncollectedMedicalWaste(): int;
    public function emptyMedicalWaste(): bool;
    public function store(MedicalWaste $entity): bool;
    public function update(array $data, int $id): bool;
    public function delete(int $id): bool;
}
