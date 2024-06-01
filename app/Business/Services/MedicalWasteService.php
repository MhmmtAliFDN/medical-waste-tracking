<?php

namespace App\Business\Services;

use App\Business\Contracts\DoctorServiceInterface;
use App\Business\Contracts\MedicalWasteServiceInterface;
use App\Business\Contracts\NurseServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\DataAccess\Contracts\MedicalWasteRepositoryInterface;
use App\Http\Requests\StoreMedicalWasteRequest;
use App\Http\Requests\UpdateMedicalWasteRequest;
use App\Models\MedicalWaste;
use Illuminate\Http\JsonResponse;

class MedicalWasteService implements MedicalWasteServiceInterface
{
    protected readonly MedicalWasteRepositoryInterface $medicalWasteRepository;
    protected readonly UserServiceInterface $userService;
    protected readonly DoctorServiceInterface $doctorService;
    protected readonly NurseServiceInterface $nurseService;

    public function __construct(MedicalWasteRepositoryInterface $medicalWasteRepository, UserServiceInterface $userService, DoctorServiceInterface $doctorService, NurseServiceInterface $nurseService)
    {
        $this->medicalWasteRepository = $medicalWasteRepository;
        $this->userService = $userService;
        $this->doctorService = $doctorService;
        $this->nurseService = $nurseService;
    }

    public function getAll(): JsonResponse
    {
        $medicalWastes = $this->medicalWasteRepository->getAll();
        if ($medicalWastes) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $medicalWastes
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getAllWithUsers(): JsonResponse
    {
        $medicalWastesWithUsers = $this->medicalWasteRepository->getAllWithUsers();
        if ($medicalWastesWithUsers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $medicalWastesWithUsers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }
    public function getAllWithUsersInDateRange($startDate, $endDate): JsonResponse
    {
        $medicalWastesWithUsersInDateRange = $this->medicalWasteRepository->getAllWithUsersInDateRange($startDate, $endDate);
        if ($medicalWastesWithUsersInDateRange) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $medicalWastesWithUsersInDateRange
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getById(int $id): JsonResponse
    {
        $medicalWaste = $this->medicalWasteRepository->getById($id);
        if ($medicalWaste) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $medicalWaste
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }

    public function getWithUser(int $id): JsonResponse
    {
        $medicalWaste = $this->medicalWasteRepository->getWithUser($id);
        if ($medicalWaste) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $medicalWaste
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirilmedi."
        ]);
    }
    public function getTotalUncollectedMedicalWaste(): JsonResponse
    {
        $totalUncollectedMedicalWaste = $this->medicalWasteRepository->getTotalUncollectedMedicalWaste();

        return response()->json([
            'success' => true,
            'message' => "Veriler getirildi.",
            'data' => $totalUncollectedMedicalWaste
        ]);
    }
    public function emptyMedicalWaste(): JsonResponse
    {
        $result = $this->medicalWasteRepository->emptyMedicalWaste();
        if ($result)
        {
            return response()->json([
                'success' => true,
                'message' => "Konteyner boşaltıldı."
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Konteyner boşaltılamadı."
        ]);
    }

    public function store(StoreMedicalWasteRequest $request): JsonResponse
    {
        $totalUncollectedMedicalWaste = $this->getTotalUncollectedMedicalWaste()->getData()->data;
        $newMedicalWaste = $request->input('waste_quantity');
        if ($totalUncollectedMedicalWaste + $newMedicalWaste > 100)
        {
            $acceptableQuantity = 100 - $totalUncollectedMedicalWaste;
            $error = "En fazla ". $acceptableQuantity . " adet ekleyebilirsiniz. Konteynerı boşaltması için personeli çağırın.";
            return response()->json([
               'success' => false,
               'error' => $error
            ], 404);
        }

        $user_id = $request->input('user_id');
        $doctor = $this->doctorService->getByUserId($user_id)->getData();
        $nurse = $this->nurseService->getByUserId($user_id)->getData();

        $medicalWaste = new MedicalWaste;
        $medicalWaste->fill([
            "created_by_type" => $doctor->success ? "App\Models\Doctor" : "App\Models\Nurse",
            "created_by_id" => $doctor->success ? $doctor->data->id : $nurse->data->id,
            "waste_type" => $request->input('waste_type'),
            "waste_quantity" => $newMedicalWaste
        ]);

        $result = $this->medicalWasteRepository->store($medicalWaste);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Atık eklendi.",
            ]);
        }
        return response()->json([
            'success' => false,
            'error' => "Atık eklenemedi.",
        ]);
    }

    public function update(UpdateMedicalWasteRequest $request): JsonResponse
    {
        $medicalWasteId = $request->input('id');
        $result = $this->medicalWasteRepository->update($request->all(), $medicalWasteId);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Veri güncellendi.",
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri güncellenemedi."
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $result = $this->medicalWasteRepository->delete($id);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Veri silindi."
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri silinemedi."
        ]);
    }
}
