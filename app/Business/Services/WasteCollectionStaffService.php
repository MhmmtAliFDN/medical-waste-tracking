<?php

namespace App\Business\Services;

use App\Business\Contracts\UserServiceInterface;
use App\Business\Contracts\WasteCollectionStaffServiceInterface;
use App\DataAccess\Contracts\WasteCollectionStaffRepositoryInterface;
use App\Http\Requests\StoreWasteCollectionStaffRequest;
use App\Http\Requests\UpdateWasteCollectionStaffRequest;
use App\Models\WasteCollectionStaff;
use Illuminate\Http\JsonResponse;

class WasteCollectionStaffService implements WasteCollectionStaffServiceInterface
{
    protected readonly WasteCollectionStaffRepositoryInterface $wasteCollectionStaffRepository;
    protected readonly UserServiceInterface $userService;

    public function __construct(WasteCollectionStaffRepositoryInterface $wasteCollectionStaffRepository, UserServiceInterface $userService)
    {
        $this->wasteCollectionStaffRepository = $wasteCollectionStaffRepository;
        $this->userService = $userService;
    }

    public function getAll(): JsonResponse
    {
        $wasteCollectionStaffs = $this->wasteCollectionStaffRepository->getAll();
        if ($wasteCollectionStaffs) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $wasteCollectionStaffs
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getAllWithUsers(): JsonResponse
    {
        $wasteCollectionStaffsWithUsers = $this->wasteCollectionStaffRepository->getAllWithUsers();
        if ($wasteCollectionStaffsWithUsers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $wasteCollectionStaffsWithUsers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getById(int $id): JsonResponse
    {
        $wasteCollectionStaff = $this->wasteCollectionStaffRepository->getById($id);
        if ($wasteCollectionStaff) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $wasteCollectionStaff
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getByUserId(int $userId): JsonResponse
    {
        $wasteCollectionStaff = $this->wasteCollectionStaffRepository->getByUserId($userId);

        if ($wasteCollectionStaff != null) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $wasteCollectionStaff
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getWithUser(int $id): JsonResponse
    {
        $wasteCollectionStaff = $this->wasteCollectionStaffRepository->getWithUser($id);
        if ($wasteCollectionStaff) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $wasteCollectionStaff
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirilmedi."
        ]);
    }

    public function store(StoreWasteCollectionStaffRequest $request): JsonResponse
    {
        $id = $request->input('user_id');
        $wasteCollectionStaff = new WasteCollectionStaff();
        $wasteCollectionStaff->fill($request->all());
        $result = $this->wasteCollectionStaffRepository->store($wasteCollectionStaff);

        if ($result) {
            $result = $this->userService->assignRole($id, 'waste collection staff')->getData();

            if ($result->success) {
                return response()->json([
                    'success' => true,
                    'message' => $result->message,
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => $result->message,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri kaydedilmedi."
        ]);
    }

    public function update(UpdateWasteCollectionStaffRequest $request): JsonResponse
    {
        $wasteCollectionStaffId = $request->input('id');
        $newUserId = $request->input('user_id');
        $oldUserId = $this->wasteCollectionStaffRepository->getWithUser($wasteCollectionStaffId)->user->id;

        $result1 = $this->userService->removeRole($oldUserId, 'waste collection staff')->getData()->success;
        $result2 = $this->userService->assignRole($newUserId, 'waste collection staff')->getData()->success;

        if ($result1 && $result2) {
            $result = $this->wasteCollectionStaffRepository->update($request->all(), $wasteCollectionStaffId);
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => "Personsel güncellendi.",
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => "Personel güncellenemedi."
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler kaydedilmedi."
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $userId = $this->wasteCollectionStaffRepository->getById($id)->user_id;
        $result = $this->userService->removeRole($userId, 'waste collection staff')->getData();

        if ($result->success) {
            $deletedEntity = $this->wasteCollectionStaffRepository->delete($id);

            if ($deletedEntity) {
                return response()->json([
                    'success' => true,
                    'message' => $result->message
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => $result->message
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri silinemedi."
        ]);
    }
}
