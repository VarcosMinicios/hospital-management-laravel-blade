<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'people_id',
        'name'
    ];

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? substr($value, 0, 3).'.'.substr($value, 3, 3).'.'.substr($value, 6, 3).'-'.substr($value, 9) : null,
            set: fn ($value) => preg_replace('/\D+/', '', $value),
        );
    }

    protected function cns(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? substr($value, 0, 3).'.'.substr($value, 3, 4).'.'.substr($value, 7, 4).'.'.substr($value, 11, 4) : null,
            set: fn ($value) => preg_replace('/\D+/', '', $value),
        );
    }

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
            set: fn ($value) => Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'),
        );
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
