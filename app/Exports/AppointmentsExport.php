<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class AppointmentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public string $fileName;

    public function __construct(public ?string $from = null, public ?string $to = null)
    {
        $this->fileName = 'appointments_' . date('Ymd_His') . '.xlsx';
    }

    public function collection()
    {
        return Appointment::with(['patient', 'doctor', 'department', 'room'])
            ->when($this->from, function ($query) {
                return $query->whereDate('scheduled_at', '>=', $this->from);
            })
            ->when($this->to, function ($query) {
                return $query->whereDate('scheduled_at', '<=', $this->to);
            })
            ->orderBy('scheduled_at', 'desc')
            ->get()
            ->map(function ($appointment) {
                return [
                    'ID'         => $appointment->id ?? '',
                    'Patient'    => $appointment->patient?->name ?? 'N/A',
                    'Doctor'     => $appointment->doctor?->name ?? 'N/A',
                    'Department' => $appointment->department?->name ?? 'N/A',
                    'Room'       => $appointment->room?->number ?? 'N/A',
                    'Date'       => $appointment->scheduled_at ? 
                                   substr(str_replace('T', ' ', $appointment->scheduled_at), 0, 16) : 'N/A',
                    'Status'     => ucfirst($appointment->status ?? 'pending'),
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Patient', 'Doctor', 'Department', 'Room', 'Date', 'Status'];
    }
}