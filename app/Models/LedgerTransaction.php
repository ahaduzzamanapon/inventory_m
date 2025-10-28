<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerTransaction extends Model
{
    use HasFactory;

    protected $table = 'new_ledger_transactions';

    protected $fillable = [
        'customer_id',
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
}
