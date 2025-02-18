<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Comission
 * @package App\Models
 * @version February 18, 2025, 11:54 am UTC
 *
 * @property string $date
 * @property string $purpose
 * @property string $employee
 * @property string $customer
 * @property number $amount
 * @property string $note
 */
class Comission extends Model
{

    public $table = 'comissions';
    



    public $fillable = [
        'date',
        'purpose',
        'employee',
        'customer',
        'amount',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'string',
        'purpose' => 'string',
        'employee' => 'string',
        'customer' => 'string',
        'amount' => 'float',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required',
        'employee' => 'required',
        'amount' => 'required'
    ];

    
}
