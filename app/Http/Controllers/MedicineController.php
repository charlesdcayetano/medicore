<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LowStockAlert;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class MedicineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin,Staff,Doctor']);
    }

    public function index()
    {
        $medicines = Medicine::latest()->paginate(15);
        // Count medicines with low stock
        $lowStock = Medicine::whereColumn('quantity', '<=', 'min_level')->count();
        // Get expiring medicines within 30 days
        $futureDate = Carbon::now()->addDays(30)->toDateString();
        $expiringSoon = Medicine::where('expiry_date', '<=', $futureDate)
            ->whereNotNull('expiry_date')
            ->count();
        return view('medicines.index', compact('medicines', 'lowStock', 'expiringSoon'));
    }

    /**
     * Show form for creating a new medicine.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created medicine in the database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'category'             => 'nullable|string|max:255',
            'quantity'             => 'required|integer|min:0',
            'min_level'            => 'required|integer|min:0',
            'expiry_date'          => 'nullable|date',
            'side_effects'         => 'nullable|string',
            'contraindications'    => 'nullable|string',
            'storage_instructions' => 'nullable|string',
        ]);

        $medicine = Medicine::create($data);

        // Log activity
        activity()->performedOn($medicine)->log("Created medicine: {$medicine->name}");

        // Notify admins if low stock on creation
        $this->notifyAdminsIfLowStock($medicine);

        return redirect()->route('medicines.index')->with('success', 'Medicine created.');
    }

    /**
     * Show form for editing the specified medicine.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified medicine in the database.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'category'             => 'nullable|string|max:255',
            'quantity'             => 'required|integer|min:0',
            'min_level'            => 'required|integer|min:0',
            'expiry_date'          => 'nullable|date',
            'side_effects'         => 'nullable|string',
            'contraindications'    => 'nullable|string',
            'storage_instructions' => 'nullable|string',
        ]);

        $medicine->update($data);

        // Log activity
        activity()->performedOn($medicine)->log("Updated medicine: {$medicine->name}");

        // Notify admins if low stock after update
        $this->notifyAdminsIfLowStock($medicine);

        return redirect()->route('medicines.index')->with('success', 'Medicine updated.');
    }

    /**
     * Remove the specified medicine from the database.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        // Log activity
        activity()->performedOn($medicine)->log("Deleted medicine: {$medicine->name}");

        return back()->with('success', 'Medicine deleted.');
    }

    /**
     * Notify all admins if the medicine stock is low.
     */
    private function notifyAdminsIfLowStock(Medicine $medicine)
    {
        if ($medicine->quantity <= $medicine->min_level) {
            \App\Models\User::where('role', 'Admin')->each(function ($admin) use ($medicine) {
                $admin->notify(new LowStockAlert(
                    $medicine->name,
                    $medicine->quantity
                ));
            });
        }
    }
}
