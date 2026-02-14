<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet_Transactions extends Model
{
    use HasFactory;

    protected $table ="wallet_transactions";

    protected $fillable = [
        'user',
        'amount',
        'type',
        'add_payment_id',
        'status',
    ];
}
