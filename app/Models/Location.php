<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Location
 * @package App\Models
 * @version January 15, 2025, 9:04 am UTC
 *
 * @property string $location_name
 * @property string $location_address
 */
class Location extends Model
{

    public $table = 'locations';
    



    public $fillable = [
        'location_name',
        'location_address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'location_name' => 'string',
        'location_address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'location_name' => 'required',
        'location_address' => 'required'
    ];

    
}
