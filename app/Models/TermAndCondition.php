<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class TermAndCondition
 * @package App\Models
 * @version January 19, 2025, 9:19 am UTC
 *
 * @property string $Title
 */
class TermAndCondition extends Model
{

    public $table = 'termandconditions';




    public $fillable = [
        'Title',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Title' => 'required'
    ];


}
