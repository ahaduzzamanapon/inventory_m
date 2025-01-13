<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Unit
 * @package App\Models
 * @version January 13, 2025, 6:09 am UTC
 *
 * @property string $Unit_Name
 */
class Unit extends Model
{

    public $table = 'units';
    



    public $fillable = [
        'Unit_Name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Unit_Name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
