<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['patient_id','doctor_id','department_id','room_id','scheduled_at','status','notes'];
    protected $casts=['scheduled_at'=>'datetime'];
    public function patient(){ return $this->belongsTo(Patient::class); }
    public function doctor(){ return $this->belongsTo(User::class,'doctor_id'); }
    public function department(){ return $this->belongsTo(Department::class); }
    public function room(){ return $this->belongsTo(Room::class); }
}
