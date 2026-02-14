<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    use HasFactory;

    protected $table ="payout_request";

    protected $fillable = [
        'user',
        'amount',
        'status',
        'completed',
    ];
}
