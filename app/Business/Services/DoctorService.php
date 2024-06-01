<?php

namespace App\Business\Services;

use App\Business\Contracts\DoctorServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\DataAccess\Contracts\DoctorRepositoryInterface;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;

class DoctorService implements DoctorServiceInterface
{
    protected readonly DoctorRepositoryInterface $doctorRepository;
    protected readonly UserServiceInterface $userService;

    public function __construct(DoctorRepositoryInterface $doctorRepository, UserServiceInterface $userService)
    {
        $this->doctorRepository = $doctorRepository;
        $this->userService = $userService;
    }

    public function getAll(): JsonResponse
    {
        $doctors = $this->doctorRepository->getAll();
        if ($doctors) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $doctors
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getAllWithUsers(): JsonResponse
    {
        $doctorsWithUsers = $this->doctorRepository->getAllWithUsers();
        if ($doctorsWithUsers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $doctorsWithUsers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getById(int $id): JsonResponse
    {
        $doctor = $this->doctorRepository->getById($id);
        if ($doctor) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $doctor
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getByUserId(int $userId): JsonResponse
    {
        $doctor = $this->doctorRepository->getByUserId($userId);

        if ($doctor != null) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $doctor
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getWithUser(int $id): JsonResponse
    {
        $doctor = $this->doctorRepository->getWithUser($id);
        if ($doctor) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $doctor
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirilmedi."
        ]);
    }

    public function store(StoreDoctorRequest $request): JsonResponse
    {
        $id = $request->input('user_id');
        $doctor = new Doctor;
        $doctor->fill($request->all());
        $result = $this->doctorRepository->store($doctor);

        if ($result) {
            $result = $this->userService->assignRole($id, 'doctor')->getData();

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

    public function update(UpdateDoctorRequest $request): JsonResponse
    {
        $doctorId = $request->input('id');
        $newUserId = $request->input('user_id');
        $oldUserId = $this->doctorRepository->getWithUser($doctorId)->user->id;

        $result1 = $this->userService->removeRole($oldUserId, 'doctor')->getData()->success;
        $result2 = $this->userService->assignRole($newUserId, 'doctor')->getData()->success;

        if ($result1 && $result2) {
            $result = $this->doctorRepository->update($request->all(), $doctorId);
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
        $userId = $this->doctorRepository->getById($id)->user_id;
        $result = $this->userService->removeRole($userId, 'doctor')->getData();

        if ($result->success) {
            $deletedEntity = $this->doctorRepository->delete($id);

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
