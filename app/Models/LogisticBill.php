<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class LogisticBill
 * @package App\Models
 * @version January 15, 2025, 8:53 am UTC
 *
 * @property string $date
 * @property integer $Sale
 * @property integer $location
 * @property integer $customer
 * @property string $amount
 * @property string $attachment
 * @property string $note
 * @property string $status
 */
class LogisticBill extends Model
{

    public $table = 'logistic_bills';
    



    public $fillable = [
        'date',
        'Sale',
        'location',
        'customer',
        'amount',
        'attachment',
        'note',
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
        'Sale' => 'integer',
        'location' => 'integer',
        'customer' => 'integer',
        'amount' => 'string',
        'attachment' => 'string',
        'note' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required',
        'location' => 'required',
        'status' => 'required'
    ];

    
}
