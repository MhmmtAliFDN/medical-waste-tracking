<?php

namespace App\Business\Contracts;

use App\Http\Requests\StoreNurseRequest;
use App\Http\Requests\UpdateNurseRequest;
use Illuminate\Http\JsonResponse;

interface NurseServiceInterface
{
    public function getAll() : JsonResponse;
    public function getAllWithUsers() : JsonResponse;
    public function getById(int $id) : JsonResponse;
    public function getByUserId(int $userId): JsonResponse;
    public function getWithUser(int $id) : JsonResponse;
    public function store(StoreNurseRequest $request) : JsonResponse;
    public function update(UpdateNurseRequest $request) : JsonResponse;
    public function delete(int $id) : JsonResponse;
}
