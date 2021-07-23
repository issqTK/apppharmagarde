<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class last_scrape_info extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'executedBy',
        'city',
        'guards_added',
        'pharmacies_added',
        'pharmacies_fails_count',
        'updated_at'
    ];
}
