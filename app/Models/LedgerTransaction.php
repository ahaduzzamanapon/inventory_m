<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_id',
        'date',
        'transaction_type',
        'description',
        'bill_amount',
        'paid_amount',
        'discount',
        'invoice_due',
        'returned_amount',
        'balance',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
