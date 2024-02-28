<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelClass extends Model
{
    use HasFactory;

    protected $table = 'travel_classes';

    protected $fillable = [
        'title'
    ];
}
