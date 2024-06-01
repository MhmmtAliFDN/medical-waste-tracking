<?php

namespace App\Business\Contracts;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Http\JsonResponse;

interface ReportServiceInterface
{
    public function getAll() : JsonResponse;
    public function getAllWithAuthorizedOfficers() : JsonResponse;
    public function getAllWithUsers(): JsonResponse;
    public function getById(int $id) : JsonResponse;
    public function getByAuthorizedOfficerId(int $authorizedOfficerId): JsonResponse;
    public function getWithAuthorizedOfficer(int $id) : JsonResponse;
    public function store(StoreReportRequest $request) : JsonResponse;
//    public function update(UpdateReportRequest $request) : JsonResponse;
    public function delete(int $id) : JsonResponse;
}
