<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSerial extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'item_serial_number',
        'sale_status',
    ];
}
