<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

/**
 * Class LogisticBill
 * @package App\Models
 * @version January 15, 2025, 8:53 am UTC
 *
 * @property string $date
 * @property integer $Sale
 * @property integer $location
 * @property integer $customer
 * @property string $amount
 * @property string $attachment
 * @property string $note
 * @property string $status
 */
class LogisticBill extends Model
{

    public $table = 'logistic_bills';




    public $fillable = [
        'date',
        'Sale',
        'location',
        'customer',
        'amount',
        'attachment',
        'note',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'Sale' => 'integer',
        'location' => 'string',
        'customer' => 'integer',
        'amount' => 'string',
        'attachment' => 'string',
        'note' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required',
        'location' => 'required',
        'status' => 'required'
    ];
    protected $dates = []; // Laravel will automatically cast 'updated_at'

    // Auto-detect and convert date fields when setting attributes
    public function setAttribute($key, $value)
    {
        if ($this->isDateColumn($key) && !empty($value)) {
            try {
                // Try parsing with expected format
                $value = Carbon::createFromFormat('d-m-Y', trim($value))->format('Y-m-d');
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error("Invalid date format for {$key}: {$value}");
            }
        }

        parent::setAttribute($key, $value);
    }

    // public function getAttribute($key)
    // {
    //     $value = parent::getAttribute($key);

    //     if ($this->isDateColumn($key) && !empty($value)) {
    //         try {
    //             return Carbon::parse($value)->format('d-m-Y');
    //         } catch (\Exception $e) {
    //             return $value; // Return original value if parsing fails
    //         }
    //     }

    //     return $value;
    // }

    private function isDateColumn($key)
    {
        static $dateColumns;

        if (!$dateColumns) {
            $dateColumns = array_filter(Schema::getColumnListing($this->getTable()), function ($column) {
                return in_array(Schema::getColumnType($this->getTable(), $column), ['date', 'datetime', 'timestamp']);
            });
        }

        return in_array($key, $dateColumns);
    }


}
