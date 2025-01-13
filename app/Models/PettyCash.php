<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PettyCash
 * @package App\Models
 * @version January 13, 2025, 7:22 am UTC
 *
 * @property string $date
 * @property string $account_ledgers
 * @property string $account_description
 * @property number $amount
 * @property string $attachment
 * @property string $status
 */
class PettyCash extends Model
{

    public $table = 'pettycash';
    



    public $fillable = [
        'date',
        'account_ledgers',
        'account_description',
        'amount',
        'attachment',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'account_ledgers' => 'string',
        'account_description' => 'string',
        'amount' => 'float',
        'attachment' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required',
        'account_ledgers' => 'required',
        'amount' => 'required',
        'status' => 'required'
    ];

    
}
