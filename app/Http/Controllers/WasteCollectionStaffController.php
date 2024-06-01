<?php

namespace App\Http\Controllers;

use App\Business\Contracts\UserServiceInterface;
use App\Business\Contracts\WasteCollectionStaffServiceInterface;
use App\Http\Requests\StoreWasteCollectionStaffRequest;
use App\Http\Requests\UpdateWasteCollectionStaffRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WasteCollectionStaffController extends Controller
{
    protected readonly WasteCollectionStaffServiceInterface $wasteCollectionStaffService;
    protected readonly UserServiceInterface $userService;
    public function __construct(WasteCollectionStaffServiceInterface $wasteCollectionStaffService, UserServiceInterface $userService)
    {
        $this->wasteCollectionStaffService = $wasteCollectionStaffService;
        $this->userService = $userService;
    }

    public function index(): View
    {
        $result = $this->wasteCollectionStaffService->getAllWithUsers();
        $responseData = $result->getData();

        if ($responseData->success) {
            $wasteCollectionStaffs = $responseData->data;
            return view('pages.waste-collection-staff.index', compact('wasteCollectionStaffs'));
        }

        return view('pages.waste-collection-staff.index')->with('message', $responseData->message);
    }

    public function create(): View
    {
        $result = $this->userService->getDoesntHaveAnyRole();
        $responseData = $result->getData();

        if ($responseData->success) {
            $users = $responseData->data;
            return view('pages.waste-collection-staff.create', compact('users'));
        }

        return view('pages.waste-collection-staff.create')->with('message', $responseData->message);
    }

    public function store(StoreWasteCollectionStaffRequest $request): JsonResponse
    {
        $result = $this->wasteCollectionStaffService->store($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('waste-collection-staff.index')
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
        return view('pages.waste-collection-staff.edit')
            ->with('wasteCollectionStaff', $this->wasteCollectionStaffService->getById($id)->getData()->data)
            ->with('users', $this->userService->getAll()->getData()->data);
    }

    public function update(UpdateWasteCollectionStaffRequest $request) : JsonResponse
    {
        $result = $this->wasteCollectionStaffService->update($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('waste-collection-staff.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }

    public function destroy(Request $request) : JsonResponse
    {
        $wasteCollectionStaffId = $request->input('id');
        $result = $this->wasteCollectionStaffService->delete($wasteCollectionStaffId)->getData();

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
