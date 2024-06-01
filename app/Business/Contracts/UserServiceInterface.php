<?php

namespace App\Business\Contracts;

use Illuminate\Http\JsonResponse;

interface UserServiceInterface
{
    public function getAll(): JsonResponse;
    public function getById(int $id): JsonResponse;
    public function getDoesntHaveAnyRole(): JsonResponse;
    public function assignRole(int $id, string $role): JsonResponse;
    public function removeRole(int $id, string $role): JsonResponse;
}
