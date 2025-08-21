<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Billing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'patient_id',
        'appointment_id',
        'total_amount',
        'status',
        'due_date',
        'billing_date', // Add missing field
        'payment_method', // Add missing field
        'notes', // Add missing field
    ];

    /**
     * Define the valid statuses for a billing record.
     */
    public static $statuses = [
        'Pending', 
        'Unpaid', 
        'Partially Paid', 
        'Paid', 
        'Voided'
    ];

    /**
     * Get the patient that owns the billing.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the appointment associated with the billing.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Get the billing items for the billing.
     */
    public function items(): HasMany
    {
        return $this->hasMany(BillingItem::class);
    }

    // Add accessor for billing_date if it doesn't exist
    public function getBillingDateAttribute($value)
    {
        if ($value) {
            return $value;
        }
        // Fallback to created_at if billing_date is not set
        return $this->created_at ? $this->created_at->toDateString() : null;
    }

    // Add accessor for payment_method if it doesn't exist
    public function getPaymentMethodAttribute($value)
    {
        return $value ?? 'Not specified';
    }

    // Add accessor for notes if it doesn't exist
    public function getNotesAttribute($value)
    {
        return $value ?? '';
    }
}
