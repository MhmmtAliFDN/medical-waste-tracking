<?php

namespace App\Business\Services;

use App\Business\Contracts\AuthorizedOfficerServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\DataAccess\Contracts\AuthorizedOfficerRepositoryInterface;
use App\Http\Requests\StoreAuthorizedOfficerRequest;
use App\Http\Requests\UpdateAuthorizedOfficerRequest;
use App\Models\AuthorizedOfficer;
use Illuminate\Http\JsonResponse;

class AuthorizedOfficerService implements AuthorizedOfficerServiceInterface
{
    protected readonly AuthorizedOfficerRepositoryInterface $authorizedOfficerRepository;
    protected readonly UserServiceInterface $userService;

    public function __construct(AuthorizedOfficerRepositoryInterface $authorizedOfficerRepository, UserServiceInterface $userService)
    {
        $this->authorizedOfficerRepository = $authorizedOfficerRepository;
        $this->userService = $userService;
    }

    public function getAll(): JsonResponse
    {
        $authorizedOfficers = $this->authorizedOfficerRepository->getAll();
        if ($authorizedOfficers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $authorizedOfficers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getAllWithUsers(): JsonResponse
    {
        $authorizedOfficersWithUsers = $this->authorizedOfficerRepository->getAllWithUsers();
        if ($authorizedOfficersWithUsers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $authorizedOfficersWithUsers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getById(int $id): JsonResponse
    {
        $authorizedOfficer = $this->authorizedOfficerRepository->getById($id);
        if ($authorizedOfficer) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $authorizedOfficer
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getByUserId(int $userId): JsonResponse
    {
        $authorizedOfficer = $this->authorizedOfficerRepository->getByUserId($userId);

        if ($authorizedOfficer != null) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $authorizedOfficer
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getWithUser(int $id): JsonResponse
    {
        $authorizedOfficer = $this->authorizedOfficerRepository->getWithUser($id);
        if ($authorizedOfficer) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $authorizedOfficer
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirilmedi."
        ]);
    }

    public function store(StoreAuthorizedOfficerRequest $request): JsonResponse
    {
        $id = $request->input('user_id');
        $authorizedOfficer = new AuthorizedOfficer();
        $authorizedOfficer->fill($request->all());
        $result = $this->authorizedOfficerRepository->store($authorizedOfficer);

        if ($result) {
            $result = $this->userService->assignRole($id, 'authorized officer')->getData();

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

    public function update(UpdateAuthorizedOfficerRequest $request): JsonResponse
    {
        $authorizedOfficerId = $request->input('id');
        $newUserId = $request->input('user_id');
        $oldUserId = $this->authorizedOfficerRepository->getWithUser($authorizedOfficerId)->user->id;

        $result1 = $this->userService->removeRole($oldUserId, 'authorized officer')->getData()->success;
        $result2 = $this->userService->assignRole($newUserId, 'authorized officer')->getData()->success;

        if ($result1 && $result2) {
            $result = $this->authorizedOfficerRepository->update($request->all(), $authorizedOfficerId);
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
        $userId = $this->authorizedOfficerRepository->getById($id)->user_id;
        $result = $this->userService->removeRole($userId, 'authorized officer')->getData();

        if ($result->success) {
            $deletedEntity = $this->authorizedOfficerRepository->delete($id);

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
