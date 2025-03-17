<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

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
        'late_status',
        'late_time'
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

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if ($this->isDateColumn($key) && !empty($value)) {
            try {
                return Carbon::parse($value)->format('d-m-Y');
            } catch (\Exception $e) {
                return $value; // Return original value if parsing fails
            }
        }

        return $value;
    }

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
