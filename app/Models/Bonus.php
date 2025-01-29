<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Bonus
 * @package App\Models
 * @version January 26, 2025, 4:18 pm UTC
 *
 * @property string $user_id
 * @property string $month
 * @property string $reason
 */
class Bonus extends Model
{

    public $table = 'bonuses';




    public $fillable = [
        'user_id',
        'month',
        'amount',
        'reason'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'string',
        'month' => 'string',
        'reason' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'month' => 'required'
    ];


}
