<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  DashboardController, PatientController, DepartmentController, RoomController,
  AppointmentController, MedicalRecordController, PrescriptionController,
  InventoryController, BillingController, AmbulanceController, UserController
};

Route::get('/', fn()=>redirect()->route('dashboard'));

Route::middleware(['auth'])->group(function () {

  Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

  // Admin only
  Route::middleware('role:Admin')->group(function () {
    Route::resource('departments', DepartmentController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('ambulances', AmbulanceController::class);
    Route::resource('users', UserController::class);
  });

  // Staff + Admin
  Route::middleware('role:Admin,Staff')->group(function () {
    Route::resource('patients', PatientController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('billings', BillingController::class);
  });

  // Doctor + Admin
  Route::middleware('role:Admin,Doctor')->group(function () {
    Route::resource('medical-records', MedicalRecordController::class);
    Route::resource('prescriptions', PrescriptionController::class);
  });

});

require __DIR__.'/auth.php';
