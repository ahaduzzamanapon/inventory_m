<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchas_id',
        'supplier_id',
        'purchas_date',
        'reference_no',
        'sub_total',
        'discount_status',
        'discount_per',
        'discount_amount',
        'tax_status',
        'tax_per',
        'tax_amount',
        'other_charges',
        'grand_total',
        'payment_status',
        'payment_amount',
        'due_amount',
    ];
}
