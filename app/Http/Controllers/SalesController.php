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
            $items_list[$item->id] = $item->item_id.' - '.$item->item_name.' ('.$item->item_model.')-'.$item->item_sale_price;
        }
        $items = $items_list;

        $paymentMethods = \App\Models\PaymentMethod::all();
        $categories = \App\Models\Category::all();
        $subCategories = \App\Models\SubCategory::all();
        return view('sales.new_sales', compact('customers', 'items', 'paymentMethods', 'categories', 'subCategories'));
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
            'payment_date' => 'nullable|array',
            'payment_amount' => 'nullable|array',
            'total_payment' => 'required|numeric',
            'due' => 'required|numeric',
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
                'payment_status' => $validated['due'] == 0 ? 'Paid' : ($validated['due'] < $validated['grand_total_input'] ? 'Partial' : 'Pending'),
                'payment_amount' => $validated['total_payment'],
                'due_amount' => $validated['due'],
            ]);

            // Insert into SalesItemModel
            foreach ($validated['item_id'] as $index => $itemId) {
                SalesItemModel::create([
                    'sale_id' => $sales->id,
                    'item_id' => $itemId,
                    'item_name' => $validated['item_name'][$index], // Replace with actual item name if available
                    'item_per_price' => $validated['price'][$index],
                    'sales_qty' => $validated['quantity'][$index],
                    'total_price' => $validated['total_price'][$index],
                ]);
                Item::where('id', $itemId)->decrement('item_qty', $validated['quantity'][$index]);
            }

            // Insert into SalesPaymentModel
            if (!empty($validated['payment_id'])) {
                foreach ($validated['payment_id'] as $index => $paymentId) {
                    SalesPaymentModel::create([
                        'payment_id' => $paymentId,
                        'customer_id' => $validated['customer_id'],
                        'payment_date' => $validated['payment_date'][$index],
                        'sale_id' => $sales->id,
                        'payment_method' => $validated['payment_method_id'][$index],
                        'payment_amount' => $validated['payment_amount'][$index],
                        'payment_status' => $validated['payment_amount'][$index] >= $validated['grand_total_input'] ? 'Completed' : 'Pending',
                    ]);
                }
            }
            DB::commit();
            session()->flash('success', 'Sales created successfully.');
            return redirect(route('sales.sales_list'));
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            dd($e->getMessage());
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






        return view('sales.show', compact('sales', 'SalesItem', 'SalesPayment','customer'));
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
        DB::beginTransaction();
        try {
            $sales = SalesModel::find($request->sales_id);
            $sales->payment_amount += $request->total_payment;
            $sales->due_amount = $request->due;
            $sales->payment_status = $request->due == 0 ? 'Paid' : 'Partial';
            $sales->save();
            foreach ($request->payment_id as $key => $value) {
                $payment = new SalesPaymentModel();
                $payment->payment_id = $value;
                $payment->customer_id = $sales->customer_id;
                $payment->payment_method = $request->payment_method_id[$key];
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
            dd($e->getMessage());
            Flash::error('Something went wrong while adding payment');
            return redirect(route('sales.sales_list'));
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
        //dd($sales,$customer,$SalesItem,$SalesPayment);

        // $salesAttributes = $sales->toArray();
        // $customerAttributes = $customer->toArray();
        // $salesItemsAttributes = $SalesItem->toArray();
        // $salesPaymentsAttributes = $SalesPayment->toArray();
        // $siteSettingsAttributes = $siteSettings->toArray();
        // $data=[
        //     '$sales' => $salesAttributes,
        //     '$customer' => $customerAttributes,
        //     '$$SalesItem' => $salesItemsAttributes,
        //     '$SalesPayment' => $salesPaymentsAttributes,
        //     '$siteSettings' => $siteSettingsAttributes
        // ];



        return view('sales.invoice', compact('sales', 'SalesItem', 'SalesPayment','customer','siteSettings'));
    }

}
