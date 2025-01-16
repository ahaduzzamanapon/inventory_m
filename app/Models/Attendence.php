<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Attendence
 * @package App\Models
 * @version January 16, 2025, 7:07 am UTC
 *
 * @property string $date
 * @property string $emp_id
 * @property string $status
 * @property string $late_status
 */
class Attendence extends Model
{

    public $table = 'attendences';
    



    public $fillable = [
        'date',
        'emp_id',
        'status',
        'late_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'string',
        'emp_id' => 'string',
        'status' => 'string',
        'late_status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required',
        'emp_id' => 'required',
        'status' => 'required',
        'late_status' => 'required'
    ];

    
}
