<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => substr($value, 0, 3).'.'.substr($value, 3, 3).'.'.substr($value, 6, 3).'-'.substr($value, 9),
            set: fn ($value) => preg_replace('/\D+/', '', $value),
        );
    }

    protected function cns(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => substr($value, 0, 3).'.'.substr($value, 3, 4).'.'.substr($value, 7, 4).'.'.substr($value, 11, 4),
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

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function getEmailAttribute()
    {
        return $this->contacts->where('type', 0)->first();
    }

    public function getPhoneAttribute()
    {
        return $this->contacts->where('type', 1)->first();
    }

    public function getCellPhoneAttribute()
    {
        return $this->contacts->where('type', 2)->first();
    }

}
