<?php
use Illuminate\Support\Facades\File;

if (!function_exists('uploadFile')) {
    /**
     * Upload a file to a specified folder and return the file path.
     *
     * @param \Illuminate\Http\UploadedFile $file The file to upload.
     * @param string $folder The folder where the file will be stored.
     * @param string|null $name Optional custom file name (without extension).
     * @return string The relative path of the uploaded file.
     */
    function uploadFile($file, $folder, $name = null)
    {
        $path = public_path($folder);

        // Ensure the directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0775, true, true);
        }

        // Generate a unique file name if not provided
        $filename = $name
            ? $name . '.' . $file->getClientOriginalExtension()
            : time() . '_' . $file->getClientOriginalName();

        // Move the file to the desired folder
        $file->move($path, $filename);

        // Return the relative path
        return $folder . '/' . $filename;
    }
}
if (!function_exists('get_customer_with_id')) {

    function get_customer_with_id($id)
    {
        return \App\Models\Customer::find($id);

    }
}
if (!function_exists('get_supplier_with_id')) {

    function get_supplier_with_id($id)
    {
        return \App\Models\Supplier::find($id);

    }
}
if (!function_exists('can')) {

    function can($key)
    {
        $group_id = auth()->user()->group_id;
        $permissions = \App\Models\RollHas::where('roll_id', $group_id)
            ->join('permissions', 'roll_has.permission_id', '=', 'permissions.id')
            ->select('permissions.key')
            ->get()
            ->pluck('key')
            ->toArray();
        if (in_array($key, $permissions)) {
            return true;
        }
        return false;
    }
}
if (!function_exists('get_item_name_by_id')) {

    function get_item_name_by_id($id)
    {
        $item=\App\Models\Item::find($id);

        if($item){
            return $item->item_name . ' ' . $item->model . ' ' . $item->origin . ' ' . $item->warranty;
        } else {
            return 'N/A';
        }
    }
}

if (!function_exists('generate_unique_id')) {
    /**
     * Generate a unique ID for various entities
     *
     * @param string $modelClass - The model class (e.g., \App\Models\SalesModel::class)
     * @param string $column - The column storing the unique ID (e.g., 'reference_no')
     * @param string $prefix - The prefix for the ID (e.g., 'REF:Sale/Slope/')
     * @param int $length - The number length (excluding prefix)
     * @return string
     */
    function generate_unique_id($modelClass, $column, $prefix=null, $length = 8)
    {
        $latestRecord = $modelClass::latest('id')->first();
        $nextNumber = 1; // Default if no records exist

        if ($latestRecord && isset($latestRecord->$column)) {
            $lastNumber = (int) substr($latestRecord->$column, strlen($prefix)); // Extract number part
            $nextNumber = $lastNumber + 1;
        }

        return $prefix . str_pad($nextNumber, $length, '0', STR_PAD_LEFT);
    }
}

// Specific Helper Functions Using the Generic Function
if (!function_exists('create_reference_id_sales')) {
    function create_reference_id_sales()
    {
        return generate_unique_id(\App\Models\SalesModel::class, 'reference_no', 'REF:Sale/Slope/');
    }
}

if (!function_exists('create_reference_id_purchase')) {
    function create_reference_id_purchase()
    {
        return generate_unique_id(\App\Models\PurchasModel::class, 'reference_no', 'REF:Pur/Slope/');
    }
}

if (!function_exists('create_sale_id_sales')) {
    function create_sale_id_sales()
    {
        return generate_unique_id(\App\Models\SalesModel::class, 'sales_id', 'Sale/Slope/');
    }
}

if (!function_exists('create_purchase_id_purchases')) {
    function create_purchase_id_purchases()
    {
        return generate_unique_id(\App\Models\PurchasModel::class, 'purchas_id', 'Pur/Slope/');
    }
}

if (!function_exists('create_item_id')) {
    function create_item_id()
    {
        return generate_unique_id(\App\Models\Item::class, 'item_id', 'IT-', 7);
    }
}

if (!function_exists('create_payment_id_sales')) {
    function create_payment_id_sales()
    {
        return generate_unique_id(\App\Models\SalesPaymentModel::class, 'payment_id', 'Pay ID-');
    }
}

if (!function_exists('create_emp_id')) {
    function create_emp_id()
    {
        return generate_unique_id(\App\Models\User::class, 'emp_id', 'EMP-');
    }
}



