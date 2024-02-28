<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightClass extends Model
{
    use HasFactory;

    protected $table = "flight_classes";

    protected $fillable = [
        'flight_id', // Adicione o campo 'flight_id' aqui
        'travel_class_id',
        'seats_limit',
    ];
}
