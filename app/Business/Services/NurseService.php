<?php

namespace App\Business\Services;

use App\Business\Contracts\NurseServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\DataAccess\Contracts\NurseRepositoryInterface;
use App\Http\Requests\StoreNurseRequest;
use App\Http\Requests\UpdateNurseRequest;
use App\Models\Nurse;
use Illuminate\Http\JsonResponse;

class NurseService implements NurseServiceInterface
{
    protected readonly NurseRepositoryInterface $nurseRepository;
    protected readonly UserServiceInterface $userService;
    public function __construct(NurseRepositoryInterface $nurseRepository, UserServiceInterface $userService)
    {
        $this->nurseRepository = $nurseRepository;
        $this->userService = $userService;
    }

    public function getAll() : JsonResponse
    {
        $nurses = $this->nurseRepository->getAll();
        if ($nurses) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $nurses
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getAllWithUsers() : JsonResponse
    {
        $nursesWithUsers = $this->nurseRepository->getAllWithUsers();
        if ($nursesWithUsers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $nursesWithUsers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getById(int $id) : JsonResponse
    {
        $nurse = $this->nurseRepository->getById($id);
        if ($nurse) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $nurse
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getByUserId(int $userId): JsonResponse
    {
        $nurse = $this->nurseRepository->getByUserId($userId);

        if ($nurse != null) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $nurse
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getWithUser(int $id): JsonResponse
    {
        $nurse = $this->nurseRepository->getWithUser($id);
        if ($nurse) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $nurse
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirilmedi."
        ]);
    }

    public function store(StoreNurseRequest $request) : JsonResponse
    {
        $id = $request->input('user_id');
        $nurse = new Nurse;
        $nurse->fill($request->all());
        $result = $this->nurseRepository->store($nurse);

        if ($result) {
            $result = $this->userService->assignRole($id, 'nurse')->getData();

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

    public function update(UpdateNurseRequest $request) : JsonResponse
    {
        $nurseId = $request->input('id');
        $newUserId = $request->input('user_id');
        $oldUserId = $this->nurseRepository->getWithUser($nurseId)->user->id;

        $result1 = $this->userService->removeRole($oldUserId, 'nurse')->getData()->success;
        $result2 = $this->userService->assignRole($newUserId, 'nurse')->getData()->success;

        if ($result1 && $result2) {
            $result = $this->nurseRepository->update($request->all(), $nurseId);
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

    public function delete(int $id) : JsonResponse
    {
        $userId = $this->nurseRepository->getById($id)->user_id;
        $result = $this->userService->removeRole($userId, 'nurse')->getData();

        if ($result->success) {
            $deletedEntity = $this->nurseRepository->delete($id);

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
