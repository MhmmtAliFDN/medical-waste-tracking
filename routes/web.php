<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\MedicalWasteController;
use App\Http\Controllers\WasteCollectionStaffController;
use App\Http\Controllers\AuthorizedOfficerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/panel', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/panel', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('doktor')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name("doctor.index");
        Route::get('/ekle', [DoctorController::class, 'create'])->name("doctor.add");
        Route::post('/kaydet', [DoctorController::class, 'store'])->name("doctor.store");
        Route::get('/duzenle/{id}', [DoctorController::class, 'edit'])->name("doctor.edit");
        Route::put('/guncelle', [DoctorController::class, 'update'])->name("doctor.update");
        Route::delete('/sil', [DoctorController::class, 'destroy'])->name('doctor.destroy');
    });
    Route::prefix('hemsire')->group(function () {
        Route::get('/', [NurseController::class, 'index'])->name("nurse.index");
        Route::get('/ekle', [NurseController::class, 'create'])->name("nurse.add");
        Route::post('/kaydet', [NurseController::class, 'store'])->name("nurse.store");
        Route::get('/duzenle/{id}', [NurseController::class, 'edit'])->name("nurse.edit");
        Route::put('/guncelle', [NurseController::class, 'update'])->name("nurse.update");
        Route::delete('/sil', [NurseController::class, 'destroy'])->name('nurse.destroy');
    });
    Route::prefix('yonetici')->group(function () {
        Route::get('/', [ManagerController::class, 'index'])->name("manager.index");
        Route::get('/ekle', [ManagerController::class, 'create'])->name("manager.add");
        Route::post('/kaydet', [ManagerController::class, 'store'])->name("manager.store");
        Route::get('/duzenle/{id}', [ManagerController::class, 'edit'])->name("manager.edit");
        Route::put('/guncelle', [ManagerController::class, 'update'])->name("manager.update");
        Route::delete('/sil', [ManagerController::class, 'destroy'])->name('manager.destroy');
    });
    Route::prefix('yetkili')->group(function () {
        Route::get('/', [AuthorizedOfficerController::class, 'index'])->name("authorized-officer.index");
        Route::get('/ekle', [AuthorizedOfficerController::class, 'create'])->name("authorized-officer.add");
        Route::post('/kaydet', [AuthorizedOfficerController::class, 'store'])->name("authorized-officer.store");
        Route::get('/duzenle/{id}', [AuthorizedOfficerController::class, 'edit'])->name("authorized-officer.edit");
        Route::put('/guncelle', [AuthorizedOfficerController::class, 'update'])->name("authorized-officer.update");
        Route::delete('/sil', [AuthorizedOfficerController::class, 'destroy'])->name('authorized-officer.destroy');
    });
    Route::prefix('atik-toplama-personeli')->group(function () {
        Route::get('/', [WasteCollectionStaffController::class, 'index'])->name("waste-collection-staff.index");
        Route::get('/ekle', [WasteCollectionStaffController::class, 'create'])->name("waste-collection-staff.add");
        Route::post('/kaydet', [WasteCollectionStaffController::class, 'store'])->name("waste-collection-staff.store");
        Route::get('/duzenle/{id}', [WasteCollectionStaffController::class, 'edit'])->name("waste-collection-staff.edit");
        Route::put('/guncelle', [WasteCollectionStaffController::class, 'update'])->name("waste-collection-staff.update");
        Route::delete('/sil', [WasteCollectionStaffController::class, 'destroy'])->name('waste-collection-staff.destroy');
    });
    Route::prefix('tibbi-atik')->group(function () {
        Route::get('/', [MedicalWasteController::class, 'index'])->name("medical-waste.index");
        Route::get('/ekle', [MedicalWasteController::class, 'create'])->name("medical-waste.add");
        Route::post('/kaydet', [MedicalWasteController::class, 'store'])->name("medical-waste.store");
        Route::get('/duzenle/{id}', [MedicalWasteController::class, 'edit'])->name("medical-waste.edit");
        Route::put('/guncelle', [MedicalWasteController::class, 'update'])->name("medical-waste.update");
        Route::delete('/sil', [MedicalWasteController::class, 'destroy'])->name('medical-waste.destroy');
        Route::post('/konteyner-bosalt', [MedicalWasteController::class, 'emptyMedicalWaste'])->name('medical-waste.emptyMedicalWaste');
        Route::get('/sistemi-guncelle', [MedicalWasteController::class, 'refreshSystem'])->name('medical-waste.refreshSystem');
    });
    Route::prefix('rapor')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name("report.index");
        Route::get('/ekle', [ReportController::class, 'create'])->name("report.add");
        Route::post('/kaydet', [ReportController::class, 'store'])->name("report.store");
        Route::get('/duzenle/{id}', [ReportController::class, 'edit'])->name("report.edit");
        Route::put('/guncelle', [ReportController::class, 'update'])->name("report.update");
        Route::delete('/sil', [ReportController::class, 'destroy'])->name('report.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
