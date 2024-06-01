<?php

namespace App\Http\Controllers;

use App\Business\Contracts\NurseServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\Http\Requests\StoreNurseRequest;
use App\Http\Requests\UpdateNurseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NurseController extends Controller
{
    protected readonly NurseServiceInterface $nurseService;
    protected readonly UserServiceInterface $userService;
    public function __construct(NurseServiceInterface $nurseService, UserServiceInterface $userService)
    {
        $this->nurseService = $nurseService;
        $this->userService = $userService;
    }

    public function index(): View
    {
        $result = $this->nurseService->getAllWithUsers();
        $responseData = $result->getData();

        if ($responseData->success) {
            $nurses = $responseData->data;
            return view('pages.nurse.index', compact('nurses'));
        }

        return view('pages.nurse.index')->with('message', $responseData->message);
    }

    public function create(): View
    {
        $result = $this->userService->getDoesntHaveAnyRole();
        $responseData = $result->getData();

        if ($responseData->success) {
            $users = $responseData->data;
            return view('pages.nurse.create', compact('users'));
        }

        return view('pages.nurse.create')->with('message', $responseData->message);
    }

    public function store(StoreNurseRequest $request): JsonResponse
    {
        $result = $this->nurseService->store($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('nurse.index')
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
        return view('pages.nurse.edit')
            ->with('nurse', $this->nurseService->getById($id)->getData()->data)
            ->with('users', $this->userService->getAll()->getData()->data);
    }

    public function update(UpdateNurseRequest $request) : JsonResponse
    {
        $result = $this->nurseService->update($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('nurse.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }

    public function destroy(Request $request) : JsonResponse
    {
        $nurseId = $request->input('id');
        $result = $this->nurseService->delete($nurseId)->getData();

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
