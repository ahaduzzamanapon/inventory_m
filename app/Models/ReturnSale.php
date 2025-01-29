<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'item_id',
        'return_qty',
        'return_serial',
        'return_amount',
        'return_date',
        'payment_status',
    ];
}
