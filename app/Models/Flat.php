<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $fillable = [
        'flat_number',
        'building_number',
        'road_number',
        'city',
        'area',
        'owner_id',
    ];
}
