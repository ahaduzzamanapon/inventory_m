<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Companie
 * @package App\Models
 * @version January 13, 2025, 10:17 am UTC
 *
 * @property string $companie_name
 * @property string $companie_address
 */
class Companie extends Model
{

    public $table = 'companies';
    



    public $fillable = [
        'companie_name',
        'companie_address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'companie_name' => 'string',
        'companie_address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'companie_name' => 'required',
        'companie_address' => 'required'
    ];

    
}
