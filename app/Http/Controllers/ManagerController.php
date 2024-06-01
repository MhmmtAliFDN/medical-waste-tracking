<?php

namespace App\Http\Controllers;

use App\Business\Contracts\ManagerServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\Http\Requests\StoreManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManagerController extends Controller
{
    protected readonly ManagerServiceInterface $managerService;
    protected readonly UserServiceInterface $userService;
    public function __construct(ManagerServiceInterface $managerService, UserServiceInterface $userService)
    {
        $this->managerService = $managerService;
        $this->userService = $userService;
    }

    public function index(): View
    {
        $result = $this->managerService->getAllWithUsers();
        $responseData = $result->getData();

        if ($responseData->success) {
            $managers = $responseData->data;
            return view('pages.manager.index', compact('managers'));
        }

        return view('pages.manager.index')->with('message', $responseData->message);
    }

    public function create(): View
    {
        $result = $this->userService->getDoesntHaveAnyRole();
        $responseData = $result->getData();

        if ($responseData->success) {
            $users = $responseData->data;
            return view('pages.manager.create', compact('users'));
        }

        return view('pages.manager.create')->with('message', $responseData->message);
    }

    public function store(StoreManagerRequest $request): JsonResponse
    {
        $result = $this->managerService->store($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('manager.index')
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
        return view('pages.manager.edit')
            ->with('manager', $this->managerService->getById($id)->getData()->data)
            ->with('users', $this->userService->getAll()->getData()->data);
    }

    public function update(UpdateManagerRequest $request) : JsonResponse
    {
        $result = $this->managerService->update($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('manager.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }

    public function destroy(Request $request) : JsonResponse
    {
        $managerId = $request->input('id');
        $result = $this->managerService->delete($managerId)->getData();

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
