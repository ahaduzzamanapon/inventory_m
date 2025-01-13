<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Supplier
 * @package App\Models
 * @version January 13, 2025, 6:53 am UTC
 *
 * @property string $supplier_name
 * @property string $supplier_email
 * @property string $supplier_phone
 * @property string $supplier_address
 */
class Supplier extends Model
{

    public $table = 'suppliers';
    



    public $fillable = [
        'supplier_name',
        'supplier_email',
        'supplier_phone',
        'supplier_address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'supplier_name' => 'string',
        'supplier_email' => 'string',
        'supplier_phone' => 'string',
        'supplier_address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'supplier_name' => 'required',
        'supplier_phone' => 'required',
        'supplier_address' => 'required'
    ];

    
}
