<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'contact',
        'type'
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
