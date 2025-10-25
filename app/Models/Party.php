<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'opening_balance',
        'image',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'zip',
    ];

    public function ledger_transactions()
    {
        return $this->hasMany(LedgerTransaction::class);
    }
}
