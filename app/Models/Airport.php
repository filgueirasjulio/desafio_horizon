<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'uf', 'country'];

    # relations
    public function flightsOrigin()
    {
        return $this->hasMany(Flight::class, 'airport_origin_id');
    }

    public function flightsDestination()
    {
        return $this->hasMany(Flight::class, 'airport_destination_id');
    }
    #end relations
}
