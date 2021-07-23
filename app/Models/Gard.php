<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gard extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'startDate',
        'endDate',
        'guard_type',
        'pharmacy_id',
        'created_at'
    ];

    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class, 'pharmacy_id', 'id');
    }
}
