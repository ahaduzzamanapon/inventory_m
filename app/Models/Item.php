<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Item
 * @package App\Models
 * @version January 13, 2025, 9:43 am UTC
 *
 * @property string $item_id
 * @property string $item_name
 * @property integer $item_category
 * @property integer $item_sub_category
 * @property string $item_model
 * @property integer $item_qty
 * @property integer $item_unit
 * @property number $item_purchase_price
 * @property number $item_sale_price
 * @property integer $item_company_id
 */
class Item extends Model
{

    public $table = 'items';




    public $fillable = [
        'item_id',
        'item_name',
        'item_category',
        'item_sub_category',
        'item_model',
        'item_qty',
        'item_unit',
        'item_purchase_price',
        'item_sale_price',
        'item_company_id',
        'item_brand_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_id' => 'string',
        'item_name' => 'string',
        'item_category' => 'integer',
        'item_sub_category' => 'integer',
        'item_model' => 'string',
        'item_qty' => 'integer',
        'item_unit' => 'integer',
        'item_purchase_price' => 'float',
        'item_sale_price' => 'float',
        'item_company_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_id' => 'required',
        'item_name' => 'required',
        'item_category' => 'required',
        'item_sub_category' => 'required',
        'item_qty' => 'required',
        'item_unit' => 'required'
    ];


}
