<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'quantity',
        'min_level',
        'expiry_date',
        'side_effects',
        'contraindications',
        'storage_instructions',
    ];

    protected $casts = [
        'expiry_date' => 'date', // ensures it's a Carbon date
    ];
}
