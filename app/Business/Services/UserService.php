<?php

namespace App\Business\Services;

use App\Business\Contracts\UserServiceInterface;
use App\DataAccess\Contracts\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class UserService implements UserServiceInterface
{
    protected readonly UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): JsonResponse
    {
        $users = $this->userRepository->getAll();
        if ($users) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $users,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getById(int $id): JsonResponse
    {
        $user = $this->userRepository->getById($id);
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $user,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getDoesntHaveAnyRole(): JsonResponse
    {
        $users = $this->userRepository->getDoesntHaveAnyRole();
        if ($users) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $users,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function assignRole(int $id, string $role): JsonResponse
    {
        $user = $this->userRepository->assignRole($id, $role);
        if ($user != null) {
            return response()->json([
                'success' => true,
                'message' => "Personel görevine atandı."
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Personel görevine atanamadı."
        ]);
    }

    public function removeRole(int $id, string $role): JsonResponse
    {
        $user = $this->userRepository->removeRole($id, $role);
        if ($user != null) {
            return response()->json([
                'success' => true,
                'message' => "Personel görevden alındı."
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Personel görevden alınamadı."
        ]);
    }
}
