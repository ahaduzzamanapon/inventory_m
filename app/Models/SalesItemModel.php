<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItemModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'item_id',
        'item_name',
        'item_per_price',
        'sales_qty',
        'total_price',
    ];
}
