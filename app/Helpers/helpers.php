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
if (!function_exists('create_reference_id_sales')) {
    function create_reference_id_sales()
    {
        $sales=\App\Models\SalesModel::orderBy('id', 'desc')->first();

        if($sales){
            $strint_t='REF:Sale/Slope/';
            $prev_reference_no=$sales->reference_no;
            $prev_reference_no=str_replace($strint_t, '', $prev_reference_no);
            $prev_reference_no=intval($prev_reference_no);
            $prev_reference_no=str_pad($prev_reference_no+1, 8, '0', STR_PAD_LEFT);
            return 'REF:Sale/Slope/'.$prev_reference_no;
        } else {
            return 'REF:Sale/Slope/00000001';
        }
    }
}
if (!function_exists('create_reference_id_purchase')) {
    function create_reference_id_purchase()
    {
        $purchases=\App\Models\PurchasModel::orderBy('id', 'desc')->first();

        if($purchases){
            $strint_t='REF:Pur/Slope/';
            $prev_reference_no=$purchases->reference_no;
            $prev_reference_no=str_replace($strint_t, '', $prev_reference_no);
            $prev_reference_no=intval($prev_reference_no);
            $prev_reference_no=str_pad($prev_reference_no+1, 8, '0', STR_PAD_LEFT);
            return 'REF:Pur/Slope/'.$prev_reference_no;
        } else {
            return 'REF:Pur/Slope/00000001';
        }
    }
}
if (!function_exists('create_sale_id_sales')) {
    function create_sale_id_sales()
    {
        $sales=\App\Models\SalesModel::orderBy('id', 'desc')->first();

        if($sales){
            $strint_t='Sale/Slope/';
            $prev_sale_id=$sales->sales_id;
            $prev_sale_id=str_replace($strint_t, '', $prev_sale_id);
            $prev_sale_id=intval($prev_sale_id);
            $prev_sale_id=str_pad($prev_sale_id+1, 8, '0', STR_PAD_LEFT);
            return 'Sale/Slope/'.$prev_sale_id;
        } else {
            return 'Sale/Slope/00000001';
        }
    }
}
if (!function_exists('create_purchase_id_purchases')) {
    function create_purchase_id_purchases()
    {
        $purchases=\App\Models\PurchasModel::orderBy('id', 'desc')->first();

        if($purchases){
            $strint_t='Pur/Slope/';
            $prev_purchase_id=$purchases->purchas_id;
            $prev_purchase_id=str_replace($strint_t, '', $prev_purchase_id);
            $prev_purchase_id=intval($prev_purchase_id);
            $prev_purchase_id=str_pad($prev_purchase_id+1, 8, '0', STR_PAD_LEFT);
            return 'Pur/Slope/'.$prev_purchase_id;
        } else {
            return 'Pur/Slope/00000001';
        }
    }
}
if (!function_exists('create_item_id')) {
    function create_item_id()
    {
        $item=\App\Models\Item::orderBy('id', 'desc')->first();
        if($item){
            $strint_t='IT-';
            $prev_item_id=$item->item_id;
            $prev_item_id=str_replace($strint_t, '', $prev_item_id);
            $prev_item_id=intval($prev_item_id);
            $prev_item_id=str_pad($prev_item_id+1, 8, '0', STR_PAD_LEFT);
            return 'IT-'.$prev_item_id;
        } else {
            return 'IT-0000001';
        }
    }
}
if (!function_exists('create_payment_id_sales')) {
    function create_payment_id_sales()
    {
        $payment=\App\Models\SalesPaymentModel::orderBy('id', 'desc')->first();
        if($payment){
            $strint_t='Pay ID-';
            $prev_payment_id=$payment->payment_id;
            $prev_payment_id=str_replace($strint_t, '', $prev_payment_id);
            $prev_payment_id=intval($prev_payment_id);
            $prev_payment_id=str_pad($prev_payment_id+1, 8, '0', STR_PAD_LEFT);
            return 'Pay ID-'.$prev_payment_id;

        } else {
            return 'Pay ID-0000001';
        }
    }
}
if (!function_exists('create_emp_id')) {
    function create_emp_id()
    {
        $user=\App\Models\User::orderBy('id', 'desc')->first();
        //dd($user);

        if($user){
            $strint_t='EMP-';
            $prev_emp_id=$user->emp_id;
            $prev_emp_id=str_replace($strint_t, '', $prev_emp_id);
            $prev_emp_id=intval($prev_emp_id);
            $prev_emp_id=str_pad($prev_emp_id+1, 8, '0', STR_PAD_LEFT);
            return 'EMP-'.$prev_emp_id;
        } else {
            return 'EMP-0000001';
        }
    }
}



