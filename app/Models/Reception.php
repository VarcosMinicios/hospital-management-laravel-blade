<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    protected $appends = ['chart'];

    protected $fillable = [
        'patient_id',
        'professional_id',
        'doctor_id',
        'nurse_id',
        'admission_date',
        'diagnosis',
        'dependency',
        'clinic',
        'security_deposit'
    ];

    // protected function peopleName(): Attribute
    // {
    //     return new Attribute(get: fn () => $this->people->name);
    // }

    // protected function doctorName(): Attribute
    // {
    //     return new Attribute(get: fn () => $this->doctor->professional->people->name);
    // }

    // protected function nurseName(): Attribute
    // {
    //     return new Attribute(get: fn () => $this->nurse->professional->people->name);
    // }

    // // protected function professionalName(): Attribute
    // // {
    // //     return new Attribute(get: fn () => $this->professional->people->name);
    // // }

    protected function chart(): Attribute
    {
        return new Attribute(get: fn () => str_pad($this->id, 8, "0", STR_PAD_LEFT));
    }

    public static function getChart(): string
    {
        return str_pad(self::latest('id')->first()->id + 1 ?? '', 8, "0", STR_PAD_LEFT);
    }

    public static function getClinics()
    {
        return [
            'Médica Geral',
            'Obstétrica',
            'Pediátrica',
            'Cirúrgica',
            'Saúde Mental'
        ];
    }

    public static function getDependencies()
    {
        return [
            'Particular',
            'SUS',
            'Convênio Particular',
            'Convênio Municipal'
        ];
    }

    protected function admissionDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
            set: fn ($value) => Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'),
        );
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}
