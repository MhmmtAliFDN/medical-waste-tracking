<?php

namespace App\Business\Services;

use App\Business\Contracts\ManagerServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\DataAccess\Contracts\ManagerRepositoryInterface;
use App\Http\Requests\StoreManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use App\Models\Manager;
use Illuminate\Http\JsonResponse;

class ManagerService implements ManagerServiceInterface
{
    protected readonly ManagerRepositoryInterface $managerRepository;
    protected readonly UserServiceInterface $userService;

    public function __construct(ManagerRepositoryInterface $managerRepository, UserServiceInterface $userService)
    {
        $this->managerRepository = $managerRepository;
        $this->userService = $userService;
    }

    public function getAll(): JsonResponse
    {
        $managers = $this->managerRepository->getAll();
        if ($managers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $managers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getAllWithUsers(): JsonResponse
    {
        $managersWithUsers = $this->managerRepository->getAllWithUsers();
        if ($managersWithUsers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $managersWithUsers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getById(int $id): JsonResponse
    {
        $manager = $this->managerRepository->getById($id);
        if ($manager) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $manager
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getByUserId(int $userId): JsonResponse
    {
        $manager = $this->managerRepository->getByUserId($userId);

        if ($manager != null) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $manager
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getWithUser(int $id): JsonResponse
    {
        $manager = $this->managerRepository->getWithUser($id);
        if ($manager) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $manager
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirilmedi."
        ]);
    }

    public function store(StoreManagerRequest $request): JsonResponse
    {
        $id = $request->input('user_id');
        $manager = new Manager();
        $manager->fill($request->all());
        $result = $this->managerRepository->store($manager);

        if ($result) {
            $result = $this->userService->assignRole($id, 'manager')->getData();

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

    public function update(UpdateManagerRequest $request): JsonResponse
    {
        $managerId = $request->input('id');
        $newUserId = $request->input('user_id');
        $oldUserId = $this->managerRepository->getWithUser($managerId)->user->id;

        $result1 = $this->userService->removeRole($oldUserId, 'manager')->getData()->success;
        $result2 = $this->userService->assignRole($newUserId, 'manager')->getData()->success;

        if ($result1 && $result2) {
            $result = $this->managerRepository->update($request->all(), $managerId);
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
        $userId = $this->managerRepository->getById($id)->user_id;
        $result = $this->userService->removeRole($userId, 'manager')->getData();

        if ($result->success) {
            $deletedEntity = $this->managerRepository->delete($id);

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
