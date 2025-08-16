<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PrescriptionItem;

class Prescription extends Model
{
    protected $fillable=['medical_record_id','prescribed_on'];
    protected $casts=['prescribed_on'=>'date'];
    public function medicalRecord(){ return $this->belongsTo(MedicalRecord::class); }
    public function items(){ return $this->hasMany(PrescriptionItem::class); }
}
