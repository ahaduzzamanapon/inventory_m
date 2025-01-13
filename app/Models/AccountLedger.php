<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class AccountLedger
 * @package App\Models
 * @version January 13, 2025, 7:13 am UTC
 *
 * @property string $name
 * @property string $type
 */
class AccountLedger extends Model
{

    public $table = 'accountledgers';
    



    public $fillable = [
        'name',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'type' => 'required'
    ];

    
}
