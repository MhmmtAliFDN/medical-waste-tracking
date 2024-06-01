<?php

namespace App\Business\Contracts;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use Illuminate\Http\JsonResponse;

interface DoctorServiceInterface
{
    public function getAll() : JsonResponse;
    public function getAllWithUsers() : JsonResponse;
    public function getById(int $id) : JsonResponse;
    public function getByUserId(int $userId): JsonResponse;
    public function getWithUser(int $id) : JsonResponse;
    public function store(StoreDoctorRequest $request) : JsonResponse;
    public function update(UpdateDoctorRequest $request) : JsonResponse;
    public function delete(int $id) : JsonResponse;
}
