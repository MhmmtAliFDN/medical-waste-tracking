<?php

namespace App\Http\Controllers;

use App\Business\Contracts\MedicalWasteServiceInterface;
use App\Http\Requests\StoreMedicalWasteRequest;
use App\Http\Requests\UpdateMedicalWasteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicalWasteController extends Controller
{
    protected readonly MedicalWasteServiceInterface $medicalWasteService;

    public function __construct(MedicalWasteServiceInterface $medicalWasteService)
    {
        $this->medicalWasteService = $medicalWasteService;
    }

    public function index(): View
    {
        $result = $this->medicalWasteService->getAllWithUsers();
        $responseData = $result->getData();

        if ($responseData->success) {
            $medicalWastes = $responseData->data;
            $totalUncollectedMedicalWaste = $this->medicalWasteService->getTotalUncollectedMedicalWaste()->getData()->data;
            return view('pages.medical-waste.index', compact('medicalWastes', 'totalUncollectedMedicalWaste'));
        }

        return view('pages.medical-waste.index')->with('message', $responseData->message);
    }

    public function create(): View
    {
        return view('pages.medical-waste.create');
    }

    public function store(StoreMedicalWasteRequest $request): JsonResponse
    {
        $result = $this->medicalWasteService->store($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('medical-waste.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->error,
        ],404);
    }

    public function show(int $id)
    {
        //
    }

    public function edit(int $id): View
    {
        $medicalWaste = $this->medicalWasteService->getWithUser($id)->getData()->data;
        if ($medicalWaste->created_by->user->id != Auth()->user()->id) {
            return abort(403, 'İŞLEM YETKİNİZ YOK.');
        }
        return view('pages.medical-waste.edit')
            ->with('medicalWaste', $medicalWaste);
    }

    public function update(UpdateMedicalWasteRequest $request): JsonResponse
    {
        $result = $this->medicalWasteService->update($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('medical-waste.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $medicalWasteId = $request->input('id');
        $medicalWaste = $this->medicalWasteService->getWithUser($medicalWasteId)->getData()->data;
        if ($medicalWaste->created_by->user->id == Auth()->user()->id) {
            $result = $this->medicalWasteService->delete($medicalWasteId)->getData();
            if ($result->success) {
                return response()->json([
                    'success' => true,
                    'message' => $result->message,
                ], 200);
            }

            return response()->json([
                'success' => false,
                'error' => $result->message,
            ], 400);
        }

        return response()->json([
            'success' => false,
            'error' => "İŞLEM YETKİNİZ YOK.",
        ], 403);
    }
    public function emptyMedicalWaste(): JsonResponse
    {
        $result = $this->medicalWasteService->emptyMedicalWaste()->getData();
        if ($result->success)
        {
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
    public function refreshSystem(): View
    {
        $result = $this->medicalWasteService->getAllWithUsers()->getData();
        if ($result->success) {
            $medicalWastes = $result->data;
            return view('partials.medical-waste-table', compact('medicalWastes'));
        }
        return view('partials.medical-waste-table')->with('message', $result->message);
    }
}
