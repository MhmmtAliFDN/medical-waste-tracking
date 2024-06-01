<?php

namespace App\Business\Contracts;

use App\Http\Requests\StoreMedicalWasteRequest;
use App\Http\Requests\UpdateMedicalWasteRequest;
use Illuminate\Http\JsonResponse;

interface MedicalWasteServiceInterface
{
    public function getAll() : JsonResponse;
    public function getAllWithUsers() : JsonResponse;
    public function getAllWithUsersInDateRange($startDate, $endDate): JsonResponse;
    public function getById(int $id) : JsonResponse;
    public function getWithUser(int $id) : JsonResponse;
    public function getTotalUncollectedMedicalWaste(): JsonResponse;
    public function emptyMedicalWaste(): JsonResponse;
    public function store(StoreMedicalWasteRequest $request) : JsonResponse;
    public function update(UpdateMedicalWasteRequest $request) : JsonResponse;
    public function delete(int $id) : JsonResponse;
}
