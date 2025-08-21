<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'department_id',
        'room_id',
        'scheduled_at',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'scheduled_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the patient that owns the appointment.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor that owns the appointment.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Get the department that owns the appointment.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the room that owns the appointment.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Scope a query to only include appointments for a specific date.
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('scheduled_at', $date);
    }

    /**
     * Scope a query to only include appointments between dates.
     */
    public function scopeBetweenDates($query, $from, $to)
    {
        return $query->whereBetween('scheduled_at', [$from, $to]);
    }

    /**
     * Get formatted scheduled date
     */
    public function getFormattedScheduledAtAttribute(): string
    {
        return $this->scheduled_at ? $this->scheduled_at->format('Y-m-d H:i') : 'N/A';
    }
}