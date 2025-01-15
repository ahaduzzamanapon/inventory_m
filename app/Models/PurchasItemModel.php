<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasItemModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchas_id',
        'item_id',
        'item_name',
        'item_per_price',
        'purchas_qty',
        'total_price',
    ];
}
