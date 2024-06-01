<?php

namespace App\Business\Contracts;

use App\Http\Requests\StoreManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use Illuminate\Http\JsonResponse;

interface ManagerServiceInterface
{
    public function getAll() : JsonResponse;
    public function getAllWithUsers() : JsonResponse;
    public function getById(int $id) : JsonResponse;
    public function getByUserId(int $userId): JsonResponse;
    public function getWithUser(int $id) : JsonResponse;
    public function store(StoreManagerRequest $request) : JsonResponse;
    public function update(UpdateManagerRequest $request) : JsonResponse;
    public function delete(int $id) : JsonResponse;
}
