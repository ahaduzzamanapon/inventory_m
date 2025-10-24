<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use App\Models\Supplier;

class PurchasModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchas_id',
        'supplier_id',
        'purchas_date',
        'reference_no',
        'sub_total',
        'discount_status',
        'discount_per',
        'discount_amount',
        'tax_status',
        'tax_per',
        'tax_amount',
        'other_charges',
        'grand_total',
        'payment_status',
        'payment_amount',
        'due_amount',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

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
