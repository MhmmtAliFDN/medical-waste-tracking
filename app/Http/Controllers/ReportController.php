<?php

namespace App\Http\Controllers;

use App\Business\Contracts\ManagerServiceInterface;
use App\Business\Contracts\ReportServiceInterface;
use App\Business\Contracts\UserServiceInterface;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    protected readonly ReportServiceInterface $reportService;

    public function __construct(ReportServiceInterface $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(): View
    {
        $result = $this->reportService->getAllWithUsers();
        $responseData = $result->getData();

        if ($responseData->success) {
            $reports = $responseData->data;
            return view('pages.report.index', compact('reports'));
        }

        return view('pages.report.index')->with('message', $responseData->message);
    }

    public function create(): View
    {
        return view('pages.report.create');
    }

    public function store(StoreReportRequest $request): JsonResponse
    {
        $result = $this->reportService->store($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('report.index')
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
        return view('pages.report.edit')
            ->with('report', $this->reportService->getById($id)->getData()->data);
    }

    public function update(UpdateReportRequest $request) : JsonResponse
    {
        $result = $this->reportService->update($request)->getData();

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'redirect' => route('report.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => $result->message,
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $reportId = $request->input('id');
        $result = $this->reportService->delete($reportId)->getData();

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
