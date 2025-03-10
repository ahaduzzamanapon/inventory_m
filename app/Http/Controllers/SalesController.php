<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Schema;
use Blueprint;
use App\Models\SalesModel;
use App\Models\SalesItemModel;
use App\Models\SalesPaymentModel;
use App\Models\Customer;
use App\Models\ReturnSale;
use App\Models\Item;
use Flash;




class SalesController extends Controller
{
    public function index()
    {
        return redirect()->route('sales.new_sales');
    }
    public function newSales()
    {
        $customers = \App\Models\Customer::all();
        $customers_list = [];
        $customers_list[''] = 'Select Customer';
        foreach ($customers as $key => $customer) {
            $customers_list[$customer->id] = $customer->customer_name.' ('.$customer->customer_phone.')';
        }
        $customers = $customers_list;

        $items = \App\Models\Item::all();
        $items_list = [];
        $items_list['select'] = 'Select Item';
        foreach ($items as $key => $item) {
            $items_list[$item->id] = $item->item_id.' -> '.$item->item_name.' ('.$item->item_model.')->'.$item->item_sale_price.'->'.$item->item_qty;
        }
        $items_list2 = [];
        $items_list2['select'] = 'Select Item';
        foreach ($items as $key => $item) {
            $items_list2[$item->id] = $item->item_id.' -> '.$item->item_name.' ('.$item->item_model.')';
        }
        $items = $items_list;
        $items2 = $items_list2;

        $paymentMethods = \App\Models\PaymentMethod::all();
        $categories = \App\Models\Category::all();
        $subCategories = \App\Models\SubCategory::all();
        return view('sales.new_sales', compact('customers', 'items','items2', 'paymentMethods', 'categories', 'subCategories'));
    }
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'customer_id' => 'required|integer',
            'sale_date' => 'required|date',
            'reference_no' => 'nullable|string',
            'sales_id' => 'required|string|unique:sales_models,sales_id',
            'item_id' => 'required|array',
            'item_name' => 'required|array',
            'quantity' => 'required|array',
            'price' => 'required|array',
            'total_price' => 'required|array',
            'tax_type' => 'required|string',
            'tax_per' => 'nullable|numeric',
            'discount_type' => 'required|string',
            'discount_per' => 'nullable|numeric',
            'sub_total_input' => 'required|numeric',
            'tax_input' => 'nullable|numeric',
            'discount_input' => 'nullable|numeric',
            'grand_total_input' => 'required|numeric',
            'payment_id' => 'nullable|array',
            'payment_method_id' => 'nullable|array',
            'cheque_number' => 'nullable|array',
            'payment_date' => 'nullable|array',
            'payment_amount' => 'nullable|array',
            'item_serial' => 'nullable|array',
            'total_payment' => 'required|numeric',
            'due' => 'required|numeric',
            'sale_note' => '',
        ]);

        DB::beginTransaction();
        try {
            // Insert into SalesModel
            $sales = SalesModel::create([
                'sales_id' => $validated['sales_id'],
                'customer_id' => $validated['customer_id'],
                'sale_date' => $validated['sale_date'],
                'reference_no' => $validated['reference_no'],
                'sub_total' => $validated['sub_total_input'],
                'discount_status' => $validated['discount_type'],
                'discount_per' => $validated['discount_per'] ?? 0,
                'discount_amount' => $validated['discount_input'] ?? 0,
                'tax_status' => $validated['tax_type'],
                'tax_per' => $validated['tax_per'] ?? 0,
                'tax_amount' => $validated['tax_input'] ?? 0,
                'grand_total' => $validated['grand_total_input'],
                'payment_status' => 'Pending',
                'payment_amount' =>0,
                'due_amount' => $validated['grand_total_input'],
                'sale_note' => $validated['sale_note'],
            ]);

            // Insert into SalesItemModel
            foreach ($validated['item_id'] as $index => $itemId) {
                $item_validate=Item::where('id', $itemId)->first();
                if ($item_validate->item_qty < $validated['quantity'][$index]) {
                    return redirect()->route('sales.new_sales')->with('error', 'Item Quantity is not enough');
                }
                SalesItemModel::create([
                    'sale_id' => $sales->id,
                    'item_id' => $itemId,
                    'item_serial' => isset($validated['item_serial'][$itemId]) ? json_encode($validated['item_serial'][$itemId]) : null,
                    'item_name' => $validated['item_name'][$index], // Replace with actual item name if available
                    'item_per_price' => $validated['price'][$index],
                    'sales_qty' => $validated['quantity'][$index],
                    'total_price' => $validated['total_price'][$index],
                ]);
                Item::where('id', $itemId)->decrement('item_qty', $validated['quantity'][$index]);
                if (isset($validated['item_serial'][$itemId])) {
                    foreach ($validated['item_serial'][$itemId] as $serial) {
                        DB::table('item_serials')->where('id', $serial)->update(['sale_status' => 2]);
                    }
                }
            }

            if (!empty($validated['payment_id'])) {
                foreach ($validated['payment_id'] as $index => $paymentId) {
                    SalesPaymentModel::create([
                        'payment_id' => $paymentId,
                        'customer_id' => $validated['customer_id'],
                        'payment_date' => $validated['payment_date'][$index],
                        'sale_id' => $sales->id,
                        'payment_method' => $validated['payment_method_id'][$index],
                        'cheque_number' => $validated['cheque_number'][$index],
                        'payment_amount' => $validated['payment_amount'][$index],
                        'payment_status' => 'Pending',
                    ]);
                }
            }



            DB::commit();
            session()->flash('success', 'Sales created successfully.');
            session()->flash('sales_id', $sales->id);
            return redirect(route('sales.sales_list'));
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            //dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    static function salesList()
    {
        $sales = SalesModel::all();
        return view('sales.sales_list', compact('sales'));
    }

    static function show($id){

        $sales = SalesModel::find($id);
        if (empty($sales)) {
            Flash::error('Sales not found');
            return redirect(route('sales.sales_list'));
        }
        $customer = Customer::find($sales->customer_id);
        $SalesItem = SalesItemModel::where('sale_id', $id)->get();
        $SalesPayment = SalesPaymentModel::where('sale_id', $id)->get();
        //dd($sales);

        $sales_return = ReturnSale::where('sale_id', $sales->sales_id)->get();






        return view('sales.show', compact('sales', 'SalesItem', 'SalesPayment','customer','sales_return'));
    }

    static function delete($id){
        DB::beginTransaction();
        $sales = SalesModel::find($id);
        if (empty($sales)) {
            Flash::error('Sales not found');
            return redirect(route('sales.sales_list'));
        }
        $sales->delete();
        $SalesItem = SalesItemModel::where('sale_id', $id)->get();
        foreach ($SalesItem as $item) {
            $item->delete();
        }
        $SalesPayment = SalesPaymentModel::where('sale_id', $id)->get();
        foreach ($SalesPayment as $payment) {
            $payment->delete();
        }
        DB::commit();
        Flash::success('Sales deleted successfully.');
        return redirect(route('sales.sales_list'));
    }

    public function make_payment($id){
        $sales = SalesModel::find($id);
        if (empty($sales)) {
            Flash::error('Sales not found');
            return redirect(route('sales.sales_list'));
        }
        $customer = Customer::find($sales->customer_id);
        $SalesItem = SalesItemModel::where('sale_id', $id)->get();
        $SalesPayment = SalesPaymentModel::where('sale_id', $id)->get();
        $paymentMethods = \App\Models\PaymentMethod::all();
        return view('sales.make_payment', compact('sales', 'SalesItem', 'SalesPayment','customer','paymentMethods'));
    }
    public function make_payment_store(Request $request){
        //dd($request->all());
        DB::beginTransaction();

        try {
             $sales = SalesModel::find($request->sales_id);
            // $sales->payment_amount += $request->total_payment;
            // $sales->due_amount = $request->due;
            // $sales->payment_status = $request->due == 0 ? 'Paid' : 'Partial';
            // $sales->save();
            foreach ($request->payment_id as $key => $value) {
                $payment = new SalesPaymentModel();
                $payment->payment_id = $value;
                $payment->customer_id = $sales->customer_id;
                $payment->payment_method = $request->payment_method_id[$key];
                $payment->cheque_number = $request->Cheque_number[$key];
                $payment->payment_date = $request->payment_date[$key];
                $payment->payment_amount = $request->payment_amount[$key];
                $payment->sale_id = $request->sales_id;
                $payment->save();
            }
            DB::commit();
            Flash::success('Payment added successfully.');
            return redirect(route('sales.sales_list'));
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            Flash::error('Something went wrong while adding payment');
            return redirect()->back()->with('error', 'Something went wrong while adding payment');
        }
    }

    public function invoice($id){
        $sales = SalesModel::find($id);
        if (empty($sales)) {
            Flash::error('Sales not found');
            return redirect(route('sales.sales_list'));
        }
        $customer = Customer::find($sales->customer_id);
        $SalesItem = SalesItemModel::where('sale_id', $id)->get();
        $SalesPayment = SalesPaymentModel::where('sale_id', $id)->get();
        $siteSettings = \App\Models\SiteSetting::first();
        return view('sales.invoice', compact('sales', 'SalesItem', 'SalesPayment','customer','siteSettings'));
    }
    public function approve_payment($id){
        $SalesPayment = SalesPaymentModel::find($id);
        $sales = SalesModel::find($SalesPayment->sale_id);
        $sales->payment_amount += $SalesPayment->payment_amount;
        $sales->due_amount = $sales->grand_total - $sales->payment_amount;
        $sales->payment_status = $sales->due_amount == 0 ? 'Paid' : 'Partial';
        $sales->save();
        $SalesPayment->payment_status = 'Completed';
        $SalesPayment->save();
        Flash::success('Payment approved successfully.');
        return redirect()->back();
    }
    public function cheque_return($id){
        $SalesPayment = SalesPaymentModel::find($id);
        // $sales = SalesModel::find($SalesPayment->sale_id);

        // $sales->payment_amount -= $SalesPayment->payment_amount;
        // $sales->due_amount = $sales->grand_total - $sales->payment_amount;
        // $sales->payment_status = $sales->due_amount == 0 ? 'Paid' : 'Partial';
        // $sales->save();

        $SalesPayment->payment_status = 'Cheque Return';
        $SalesPayment->save();
        Flash::success('Payment approved successfully.');
        return redirect()->back();
    }

    public function check_item_serial(Request $request){
        $item = Item::where('id', $request->item_id)->first();

        if($item->item_variant_status ==2){
            $item_serial = DB::table('item_serials')->where('item_id', $item->id)->where('sale_status', 1)->get();
            $item_serials = '';
            foreach ($item_serial as $key => $value) {
                $item_serials .= "<input type='checkbox' onchange='checkItemSerial(".$item->id.")' class='item_serial".$item->id."' name='item_serial[".$item->id."][]' value='".$value->id."'>".$value->item_serial_number."<br>";
            }
           $div_data= $item_serials;
           $serial_status = 2;
        }else{
            $div_data = "";
            $serial_status = 1;
        }
        return response()->json(['div_data' => $div_data, 'serial_status' => $serial_status]);
    }

    public function sales_return(){
        $sales = SalesModel::all()->pluck('sales_id', 'sales_id')->prepend('Select Sales ID', '');
        return view('sales.sales_return', compact('sales'));
    }

    public function get_return_sale_data(Request $request){
        $sales = SalesModel::where('sales_id', $request->sales_id)->first();
        $customer = Customer::find($sales->customer_id);
        $SalesItem = SalesItemModel::where('sale_id', $sales->id)->get();
        $SalesPayment = SalesPaymentModel::where('sale_id', $sales->id)->get();
        return view('sales.sales_item_data', compact('sales', 'SalesItem'));
    }
    public function return_store(Request $request){
        //dd($request->all());
        DB::beginTransaction();
        try {
            foreach ($request->sales_details_id as $key => $value) {
                if ( $request->return_qty[$key] == 0 || $request->return_qty[$key] == '' ) {
                    continue;
                }
                $SalesItem = SalesItemModel::where('id', $value)->first();

                $item_id = $SalesItem->item_id;
                $return_qty = $request->return_qty[$key] ?? 0;
                $return_amount = $request->return_amount[$key] ?? 0;
                $salesItem = ReturnSale::create([
                    'sale_id' => $request->sales_id,
                    'item_id' => $item_id,
                    'return_qty' => $return_qty,
                    'return_serial' => isset($request->return_serial[$value]) ? json_encode($request->return_serial[$value]) : null,
                    'return_amount' => $return_amount,
                    'return_date' => date('Y-m-d'),
                    'payment_status' => 'Pending',
                ]);
                $item = Item::find($item_id);
                $item->item_qty += $return_qty;
                $item->save();
            }
            foreach ($request->sales_details_id as $key => $value) {
                if (isset($request->return_serial[$value])) {
                    foreach ($request->return_serial[$value] as $serial) {
                        DB::table('item_serials')->where('id', $serial)->update(['sale_status' => 1]);
                    }
                }
            }
            DB::commit();
            Flash::success('Sales returned successfully.');
            return redirect(route('sales.sales_list'));
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Flash::error('Something went wrong while returning sales');
            return redirect(route('sales.sales_list'));
        }

    }
    public function sales_return_payment($id){
        $sales = ReturnSale::find($id);
        if (empty($sales)) {
            Flash::error('Return not found');
            return redirect(route('sales.sales_list'));
        }else{
            $sales->payment_status = 'Completed';
            $sales->save();
            Flash::success('Payment approved successfully.');
            return redirect()->back();
        }

        return view('sales.sales_return_payment', compact('sales'));
    }


    public function edit($id)
    {
        $sales = SalesModel::find($id);
        if (empty($sales)) {
            Flash::error('Sales not found');
            return redirect(route('sales.sales_list'));
        }
        $customer = Customer::find($sales->customer_id);
        $SalesItem = SalesItemModel::where('sale_id', $id)->get();
        $SalesPayment = SalesPaymentModel::where('sale_id', $id)->get();
        return view('sales.edit', compact('sales', 'SalesItem', 'SalesPayment','customer'));
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $sales = SalesModel::find($id);
            if (empty($sales)) {
                Flash::error('Sales not found');
                return redirect(route('sales.sales_list'));
            }
            $sales->sub_total = $request->sub_total;
            $sales->grand_total = $request->grand_total;
            $sales->due_amount = $request->grand_total-$sales->payment_amount;
            $sales->save();
            foreach ($request->item_id as $key => $value) {
                $salesItem = SalesItemModel::where('item_id', $value)->where('sale_id', $id)->first();
                if (!empty($salesItem)) {
                    $salesItem->item_per_price = $request->item_per_price[$key];
                    $salesItem->total_price = $request->total_price[$key];
                    $salesItem->save();
                }else{
                    DB::rollBack();
                    Flash::error('Something went wrong while updating sales');
                    return redirect(route('sales.sales_list'));
                }
            }
            DB::commit();
            Flash::success('Sales updated successfully.');
            return redirect(route('sales.sales_list'));
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Flash::error('Something went wrong while updating sales');
            return redirect(route('sales.sales_list'));
        }
    }
}