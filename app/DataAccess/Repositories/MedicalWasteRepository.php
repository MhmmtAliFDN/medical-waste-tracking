<?php

namespace App\DataAccess\Repositories;

use App\DataAccess\Contracts\MedicalWasteRepositoryInterface;
use App\Models\MedicalWaste;
use Illuminate\Database\Eloquent\Collection;

class MedicalWasteRepository implements MedicalWasteRepositoryInterface
{
    public function getAll(): Collection
    {
        return MedicalWaste::get();
    }

    public function getAllWithUsers(): Collection
    {
        return MedicalWaste::with('createdBy.user')->get();
    }
    public function getAllWithUsersInDateRange($startDate, $endDate): Collection
    {
        return MedicalWaste::with('createdBy.user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
    }

    public function getById(int $id): ?MedicalWaste
    {
        return MedicalWaste::find($id);
    }

    public function getWithUser(int $id): \Illuminate\Database\Eloquent\Model|Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return MedicalWaste::with('createdBy.user')->find($id);
    }
    public function getTotalUncollectedMedicalWaste(): int
    {
        return MedicalWaste::where('status', 'Toplanmadı')->sum('waste_quantity');
    }
    public function emptyMedicalWaste(): bool
    {
        return MedicalWaste::where('status', 'Toplanmadı')->update(['status' => 'Toplandı']);
    }

    public function store(MedicalWaste $entity): bool
    {
        return $entity->save();
    }

    public function update(array $data, int $id): bool
    {
        return $this->getById($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return MedicalWaste::destroy($id);
    }
}
