<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Brand
 * @package App\Models
 * @version January 13, 2025, 6:05 am UTC
 *
 * @property string $BrandName
 */
class Brand extends Model
{

    public $table = 'brands';
    



    public $fillable = [
        'BrandName'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'BrandName' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'BrandName' => 'required'
    ];

    
}
