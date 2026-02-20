<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerTransaction extends Model
{
    use HasFactory;

    protected $table = 'new_ledger_transactions';

    protected $fillable = [
        'organization_id',
        'customer_id',
        'supplier_id',
        'sale_id',
        'purchase_id',
        'date',
        'transaction_type',
        'amount',
        'balance',
        'description',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function sale()
    {
        return $this->belongsTo(SalesModel::class, 'sale_id');
    }

    public function purchase()
    {
        return $this->belongsTo(PurchasModel::class, 'purchase_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
