<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'location_url',
        'gmaps_url',
        'lat',
        'long',
        'city_id'
    ];

    public function gards(){
      return $this->hasMany(Gard::class, 'pharmacy_id', 'id');
    }
}
