<?php

namespace App\Business\Contracts;

use App\Http\Requests\StoreAuthorizedOfficerRequest;
use App\Http\Requests\UpdateAuthorizedOfficerRequest;
use Illuminate\Http\JsonResponse;

interface AuthorizedOfficerServiceInterface
{
    public function getAll() : JsonResponse;
    public function getAllWithUsers() : JsonResponse;
    public function getById(int $id) : JsonResponse;
    public function getByUserId(int $userId): JsonResponse;
    public function getWithUser(int $id) : JsonResponse;
    public function store(StoreAuthorizedOfficerRequest $request) : JsonResponse;
    public function update(UpdateAuthorizedOfficerRequest $request) : JsonResponse;
    public function delete(int $id) : JsonResponse;
}
