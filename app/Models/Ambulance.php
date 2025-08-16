<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ambulance extends Model
{
    protected $fillable=['plate_number','status','driver_name'];
}
