<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class SubCategory
 * @package App\Models
 * @version January 13, 2025, 5:25 am UTC
 *
 * @property string $SubCategoryName
 * @property integer $Category
 */
class SubCategory extends Model
{

    public $table = 'subcategorys';
    



    public $fillable = [
        'SubCategoryName',
        'Category'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'SubCategoryName' => 'string',
        'Category' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'SubCategoryName' => 'required',
        'Category' => 'required'
    ];

    
}
