<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        foreach ($customers as $key => $customer) {
            $customers_list[$customer->id] = $customer->customer_name.' ('.$customer->customer_phone.')';
        }

        $customers = $customers_list;




        $items = \App\Models\Item::all();

        $items_list = [];
        foreach ($items as $key => $item) {
            $items_list[$item->id] = $item->item_id.' - '.$item->item_name.' ('.$item->item_model.')';
        }

        $items = $items_list;




        $paymentMethods = \App\Models\PaymentMethod::all();
        $categories = \App\Models\Category::all();
        $subCategories = \App\Models\SubCategory::all();
        return view('sales.new_sales', compact('customers', 'items', 'paymentMethods', 'categories', 'subCategories'));
    }
    public function new_sales_store(Request $request)
    {
        dd($request->all());
    }
}
