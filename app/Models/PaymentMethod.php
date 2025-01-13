<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PaymentMethod
 * @package App\Models
 * @version January 13, 2025, 7:04 am UTC
 *
 * @property string $method_name
 * @property string $method_type
 * @property string $method_number
 */
class PaymentMethod extends Model
{

    public $table = 'paymentmethods';
    



    public $fillable = [
        'method_name',
        'method_type',
        'method_number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'method_name' => 'string',
        'method_type' => 'string',
        'method_number' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'method_name' => 'required',
        'method_type' => 'required',
        'method_number' => 'required'
    ];

    
}
