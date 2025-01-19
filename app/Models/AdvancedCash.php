<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class AdvancedCash
 * @package App\Models
 * @version January 19, 2025, 3:54 am UTC
 *
 * @property integer $member_id
 * @property integer $purpose
 * @property integer $amount
 * @property string $status
 */
class AdvancedCash extends Model
{

    public $table = 'advanced_cash';




    public $fillable = [
        'member_id',
        'purpose',
        'amount',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'member_id' => 'integer',
        'purpose' => 'string',
        'amount' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'member_id' => 'required',
        'purpose' => 'required',
        'amount' => 'required',
        'status' => 'required'
    ];


}
