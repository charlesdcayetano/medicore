<?php

use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;

use App\Http\Controllers\{
    HomeController, DashboardController, PatientController, DepartmentController, RoomController,
    AppointmentController, MedicalRecordController, PrescriptionController,
    InventoryController, BillingController, AmbulanceController, UserController,
    MedicineController, ReportController, ImportController, NotificationController
};


// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('appointments/export', [AppointmentController::class, 'export'])->name('appointments.export');


// Protected routes
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{id}/read', [NotificationController::class, 'markRead'])->name('read');
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');

        // Admin system-wide
        Route::post('/system', [NotificationController::class, 'broadcast'])
            ->middleware('role:Admin')->name('system');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/patients', [ReportController::class, 'patients'])->name('patients');
        Route::get('/appointments', [ReportController::class, 'appointments'])->name('appointments');
        Route::get('/medicines', [ReportController::class, 'medicines'])->name('medicines');
        Route::get('/billing', [ReportController::class, 'billing'])->name('billing');
        Route::get('/revenue', [ReportController::class, 'revenue'])->name('revenue');
        Route::get('/inventory', [ReportController::class, 'inventory'])->name('inventory');

        // Export
        Route::get('/appointments.xlsx', [ReportController::class, 'appointmentsExcel'])->name('appointments.excel');
        Route::get('/appointments.pdf', [ReportController::class, 'appointmentsPdf'])->name('appointments.pdf');
        Route::get('/inventory.pdf', [ReportController::class, 'inventoryPdf'])->name('inventory.pdf');
    });

    // Import/Export
    Route::prefix('import')->name('import.')->group(function () {
        Route::get('/', [ImportController::class, 'form'])->name('form');
        Route::post('/', [ImportController::class, 'upload'])->name('upload');
        Route::get('/template/{entity}', [ImportController::class, 'template'])->name('template');
    });

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
        Route::resource('medicines', MedicineController::class);

        Route::get('/medicines/category/{category}', [MedicineController::class, 'byCategory'])->name('medicines.by-category');
        Route::get('/medicines/low-stock', [MedicineController::class, 'lowStock'])->name('medicines.low-stock');
        Route::get('/medicines/expiring-soon', [MedicineController::class, 'expiringSoon'])->name('medicines.expiring-soon');
    });

    // Doctor + Admin
    Route::middleware('role:Admin,Doctor')->group(function () {
        Route::resource('medical-records', MedicalRecordController::class);
        Route::resource('prescriptions', PrescriptionController::class);
    });

    // Audit log
    Route::get('/audit', function () {
    $logs = Activity::latest()->paginate(30);
    return view('audit.index', compact('logs'));
})->name('audit.index');

});

require __DIR__ . '/auth.php';
