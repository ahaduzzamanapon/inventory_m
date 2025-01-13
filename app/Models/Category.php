<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Category
 * @package App\Models
 * @version January 13, 2025, 5:13 am UTC
 *
 * @property string $Name
 */
class Category extends Model
{

    public $table = 'categorys';
    



    public $fillable = [
        'Name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Name' => 'required'
    ];

    
}
