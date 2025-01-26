<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasPaymentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'supplier_id',
        'payment_date',
        'purchas_id',
        'payment_method',
        'cheque_number',
        'payment_amount',
        'payment_status',
    ];
}
