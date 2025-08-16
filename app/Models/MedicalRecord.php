<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prescription;

class MedicalRecord extends Model
{
    protected $fillable=['patient_id','doctor_id','visit_date','diagnosis','treatment','notes'];
    protected $casts=['visit_date'=>'date'];
    public function patient(){ return $this->belongsTo(Patient::class); }
    public function doctor(){ return $this->belongsTo(User::class,'doctor_id'); }
    public function prescriptions(){ return $this->hasMany(Prescription::class); }
}
