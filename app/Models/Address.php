<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function cep(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => substr($value, 0, 2).'.'.substr($value, 2, 5).'-'.substr($value, 5, 8),
            set: fn ($value) => str_replace('.', '', str_replace('-', '', $value)),
        );
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
