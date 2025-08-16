<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Billing; 

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'email',
        'address',
        'emergency_contact'
    ];
    
    protected $casts = [
        'date_of_birth' => 'date',
    ];
    
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
    
    public function getFullNameAttribute() 
    { 
        return "{$this->first_name} {$this->last_name}"; 
    }
}
