<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class ReturnSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'item_id',
        'return_qty',
        'return_serial',
        'return_amount',
        'return_date',
        'payment_status',
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
