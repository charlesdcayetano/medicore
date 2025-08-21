<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Billing;
use App\Models\Department;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'phone', // Add phone field for compatibility
        'email',
        'address',
        'emergency_contact',
        'blood_type',
        'allergies',
        'department_id',
        'status'
    ];
    
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // Add missing fields as attributes for backward compatibility
    public function getPhoneAttribute()
    {
        return $this->contact_number;
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['contact_number'] = $value;
    }
    
    public function appointments() 
    { 
        return $this->hasMany(Appointment::class); 
    }
    
    public function medicalRecords() 
    { 
        return $this->hasMany(MedicalRecord::class); 
    }
    
    public function billings() 
    { 
        return $this->hasMany(Billing::class); 
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function getFullNameAttribute() 
    { 
        return "{$this->first_name} {$this->last_name}"; 
    }

    // Add status field with default value
    public function getStatusAttribute($value)
    {
        return $value ?? 'Active';
    }

    // Add blood_type field with default value
    public function getBloodTypeAttribute($value)
    {
        return $value ?? 'Unknown';
    }

    // Add allergies field with default value
    public function getAllergiesAttribute($value)
    {
        return $value ?? 'None';
    }
}
