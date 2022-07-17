<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'cep',
        'street_type',
        'street',
        'number',
        'state',
        'city',
        'neighborhood',
        'ibge',
        'reference',
        'complement'
    ];
}
