<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nurse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'professional_id',
        'coren'
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}
