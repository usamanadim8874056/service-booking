<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table ="users";

    protected $fillable = [
        'first_name',
        'last_name',
        'user_phone',
        'user_email',
        'user_password',
        'status',
    ];
}
