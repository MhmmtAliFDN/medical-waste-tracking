<?php

namespace App\Http\Controllers;

use App\Business\Contracts\AuthorizedOfficerServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\Http\Requests\StoreAuthorizedOfficerRequest;
use App\Http\Requests\UpdateAuthorizedOfficerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorizedOfficerController extends Controller
{
    protected readonly AuthorizedOfficerServiceInterface $authorizedOfficerService;
    protected readonly UserServiceInterface $userService;
    public function __construct(AuthorizedOfficerServiceInterface $authorizedOfficerService, UserServiceInterface $userService)
    {
        $this->authorizedOfficerService = $authorizedOfficerService;
        $this->userService = $userService;
    }

    public function index(): View
    {
        $result = $this->authorizedOfficerService->getAllWithUsers();
        $responseData = $result->getData();

        if ($responseData->success) {
            $authorizedOfficers = $responseData->data;
            return view('pages.authorized-officer.index', compact('authorizedOfficers'));
        }

        return view('pages.authorized-officer.index')->with('message', $responseData->message);
    }

    public function create(): View
    {
        $result = $this->userService->getDoesntHaveAnyRole();
        $responseData = $result->getData();

        if ($responseData->success) {
            $users = $responseData->data;
            return view('pages.authorized-officer.create', compact('users'));
        }

        return view('pages.authorized-officer.create')->with('message', $responseData->message);
    }

    public function store(StoreAuthorizedOfficerRequest $request): JsonResponse
    {
        $result = $this->authorizedOfficerService->store($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('authorized-officer.index')
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
        return view('pages.authorized-officer.edit')
            ->with('authorizedOfficer', $this->authorizedOfficerService->getById($id)->getData()->data)
            ->with('users', $this->userService->getAll()->getData()->data);
    }

    public function update(UpdateAuthorizedOfficerRequest $request) : JsonResponse
    {
        $result = $this->authorizedOfficerService->update($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('authorized-officer.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }

    public function destroy(Request $request) : JsonResponse
    {
        $authorizedOfficerId = $request->input('id');
        $result = $this->authorizedOfficerService->delete($authorizedOfficerId)->getData();

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
