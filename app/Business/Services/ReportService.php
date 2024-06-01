<?php

namespace App\Business\Services;

use App\Business\Contracts\AuthorizedOfficerServiceInterface;
use App\Business\Contracts\ManagerServiceInterface;
use App\Business\Contracts\MedicalWasteServiceInterface;
use App\Business\Contracts\ReportServiceInterface;
use App\DataAccess\Contracts\ReportRepositoryInterface;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class ReportService implements ReportServiceInterface
{
    protected readonly ReportRepositoryInterface $reportRepository;
    protected readonly AuthorizedOfficerServiceInterface $authorizedOfficerService;
    protected readonly MedicalWasteServiceInterface $medicalWasteService;

    public function __construct(ReportRepositoryInterface $reportRepository, AuthorizedOfficerServiceInterface $authorizedOfficerService, MedicalWasteServiceInterface $medicalWasteService)
    {
        $this->reportRepository = $reportRepository;
        $this->authorizedOfficerService = $authorizedOfficerService;
        $this->medicalWasteService = $medicalWasteService;
    }

    public function getAll(): JsonResponse
    {
        $reports = $this->reportRepository->getAll();
        if ($reports) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $reports
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }
    public function getAllWithAuthorizedOfficers(): JsonResponse
    {
        $reportsWithAuthorizedOfficers = $this->reportRepository->getAllWithAuthorizedOfficers();
        if ($reportsWithAuthorizedOfficers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $reportsWithAuthorizedOfficers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getAllWithUsers(): JsonResponse
    {
        $reportsWithUsers = $this->reportRepository->getAllWithUsers();
        if ($reportsWithUsers) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $reportsWithUsers
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirelemedi."
        ]);
    }

    public function getById(int $id): JsonResponse
    {
        $report = $this->reportRepository->getById($id);
        if ($report) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $report
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }
    public function getByAuthorizedOfficerId(int $authorizedOfficerId): JsonResponse
    {
        $report = $this->reportRepository->getByAuthorizedOfficerId($authorizedOfficerId);

        if ($report != null) {
            return response()->json([
                'success' => true,
                'message' => "Veri getirildi.",
                'data' => $report
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri getirilmedi."
        ]);
    }
    public function getWithAuthorizedOfficer(int $id): JsonResponse
    {
        $report = $this->reportRepository->getWithAuthorizedOfficer($id);
        if ($report) {
            return response()->json([
                'success' => true,
                'message' => "Veriler getirildi.",
                'data' => $report
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veriler getirilmedi."
        ]);
    }

    public function store(StoreReportRequest $request): JsonResponse
    {
        $userId = $request->input('user_id');
        $authorizedOfficer = $this->authorizedOfficerService->getByUserId($userId)->getData();
        $title = $request->input('title');

        $dateRange = $request->input('date_range');
        [$startDate, $endDate] = explode(' - ', $dateRange);
        $start = Carbon::createFromFormat('d/m/Y', $startDate);
        $end = Carbon::createFromFormat('d/m/Y', $endDate);
        $daysDifference = $start->diffInDays($end);
        $fileName = $daysDifference . '-gunluk-rapor-'.uuid_create().'.pdf';

        $report = new Report;
        $report->fill([
            "authorized_officer_id" => $authorizedOfficer->data->id,
            "title" => $title,
            "content" => 'pdf'. DIRECTORY_SEPARATOR . 'reports'. DIRECTORY_SEPARATOR . $fileName
        ]);

        $result = $this->reportRepository->store($report);
        $this->createPdfReport($fileName, $start, $end);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Rapor oluşturuldu.",
            ]);
        }
        return response()->json([
            'success' => false,
            'error' => "Rapor oluşturulamadı.",
        ]);
    }

    public function update(UpdateReportRequest $request): JsonResponse
    {
        $reportId = $request->input('id');
        $result = $this->reportRepository->update($request->all(), $reportId);

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
        $result = $this->reportRepository->delete($id);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Veri silindi."
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Veri silinmedi."
        ]);
    }
    private function createPdfReport($fileName, $start, $end): void
    {
        $medicalWastes = $this->medicalWasteService->getAllWithUsersInDateRange($start, $end)->getData()->data;

        // HTML içeriğini oluştur
        $html = '<h1>Medical Wastes Report</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>ID</th>';
        $html .= '<th>Authorized Officer ID</th>';
        $html .= '<th>Title</th>';
        $html .= '<th>Content</th>';
        $html .= '<th>Created At</th>';
        $html .= '<th>Updated At</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($medicalWastes as $medicalWaste) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($medicalWaste->id) . '</td>';
            $html .= '<td>' . htmlspecialchars($medicalWaste->created_by->user->name . " (" . $medicalWaste->created_by_type .")") . '</td>';
            $html .= '<td>' . htmlspecialchars($medicalWaste->waste_type) . '</td>';
            $html .= '<td>' . htmlspecialchars($medicalWaste->waste_quantity) . '</td>';
            $html .= '<td>' . htmlspecialchars($medicalWaste->created_at) . '</td>';
            $html .= '<td>' . htmlspecialchars($medicalWaste->status) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);

        $directoryPath = public_path('pdf/reports');

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        $filePath = "{$directoryPath}/{$fileName}";
        $pdf->save($filePath);
    }
}
