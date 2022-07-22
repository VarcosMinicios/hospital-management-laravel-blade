<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['name'];

    protected $fillable = [
        'professional_id',
        'crm',
        'specialty'
    ];

    protected function name(): Attribute
    {
        return new Attribute(get: fn () => $this->professional->people->name);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}
