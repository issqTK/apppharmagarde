<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'guard_type',
        'endHoure',
        'startHoure',
        'rythm',
        'city_id'
    ];

}
