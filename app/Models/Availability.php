<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $table = 'availability';

    public $timestamps = false;

    protected $fillable = [
        'provider',
        'day',
        'from_time',
        'to_time',
    ];
}
