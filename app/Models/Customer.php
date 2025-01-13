<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Customer
 * @package App\Models
 * @version January 13, 2025, 6:47 am UTC
 *
 * @property string $customer_name
 * @property string $customer_email
 * @property string $customer_phone
 * @property string $customer_address
 */
class Customer extends Model
{

    public $table = 'customers';
    



    public $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customer_name' => 'string',
        'customer_email' => 'string',
        'customer_phone' => 'string',
        'customer_address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer_name' => 'required',
        'customer_phone' => 'required',
        'customer_address' => 'required'
    ];

    
}
