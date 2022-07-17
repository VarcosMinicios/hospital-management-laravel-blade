<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'professional_id',
        'doctor_id',
        'nurse_id',
        'admission_date',
        'diagnosis',
        'dependency',
        'clinic'
    ];
}
