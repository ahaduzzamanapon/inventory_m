<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPaymentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'customer_id',
        'payment_date',
        'sale_id',
        'payment_method',
        'payment_amount',
        'payment_status',
    ];
}
