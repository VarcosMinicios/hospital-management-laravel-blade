<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory, SoftDeletes, HasFactory;

    protected $fillable = [
        'address_id',
        'cpf',
        'name',
        'rg',
        'cns',
        'birth_date',
        'mother_name',
        'father_name',
        'unknown_father',
        'gender',
        'nationality',
        'skin_color',
        'profession'
    ];
}
