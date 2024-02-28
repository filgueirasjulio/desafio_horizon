<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchReason extends Model
{
    use HasFactory;

    protected $table = 'dispatch_reasons';

    protected $fillable = [
        'title',
    ];

}
