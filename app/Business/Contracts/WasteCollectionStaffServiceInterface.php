<?php

namespace App\Business\Contracts;

use App\Http\Requests\StoreWasteCollectionStaffRequest;
use App\Http\Requests\UpdateWasteCollectionStaffRequest;
use Illuminate\Http\JsonResponse;

interface WasteCollectionStaffServiceInterface
{
    public function getAll() : JsonResponse;
    public function getAllWithUsers() : JsonResponse;
    public function getById(int $id) : JsonResponse;
    public function getByUserId(int $userId): JsonResponse;
    public function getWithUser(int $id) : JsonResponse;
    public function store(StoreWasteCollectionStaffRequest $request) : JsonResponse;
    public function update(UpdateWasteCollectionStaffRequest $request) : JsonResponse;
    public function delete(int $id) : JsonResponse;
}
