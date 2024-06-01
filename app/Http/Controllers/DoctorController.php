<?php

namespace App\Http\Controllers;

use App\Business\Contracts\DoctorServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    protected readonly DoctorServiceInterface $doctorService;
    protected readonly UserServiceInterface $userService;
    public function __construct(DoctorServiceInterface $doctorService, UserServiceInterface $userService)
    {
        $this->doctorService = $doctorService;
        $this->userService = $userService;
    }

    public function index(): View
    {
        $result = $this->doctorService->getAllWithUsers();
        $responseData = $result->getData();

        if ($responseData->success) {
            $doctors = $responseData->data;
            return view('pages.doctor.index', compact('doctors'));
        }

        return view('pages.doctor.index')->with('message', $responseData->message);
    }

    public function create(): View
    {
        $result = $this->userService->getDoesntHaveAnyRole();
        $responseData = $result->getData();

        if ($responseData->success) {
            $users = $responseData->data;
            return view('pages.doctor.create', compact('users'));
        }

        return view('pages.doctor.create')->with('message', $responseData->message);
    }

    public function store(StoreDoctorRequest $request): JsonResponse
    {
        $result = $this->doctorService->store($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('doctor.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }

    public function show(int $id)
    {
        //
    }

    public function edit(int $id) : View
    {
        return view('pages.doctor.edit')
            ->with('doctor', $this->doctorService->getById($id)->getData()->data)
            ->with('users', $this->userService->getAll()->getData()->data);
    }

    public function update(UpdateDoctorRequest $request) : JsonResponse
    {
        $result = $this->doctorService->update($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('doctor.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }

    public function destroy(Request $request) : JsonResponse
    {
        $doctorId = $request->input('id');
        $result = $this->doctorService->delete($doctorId)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }
}
