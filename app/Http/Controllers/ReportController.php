<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    //sales
    public function sales_report_page()
    {
        $customers = DB::table('customers')->get();
        return view('report.sales.sales_report_page', compact('customers'));
    }
    public function sales_report(Request $request)
    {
        $customer = $request->customer_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if($to_date == null || $to_date == ''){
            $to_date = $from_date;
        }
        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));
        $report_title="Sales Report From $from_date to $to_date";
        $sales = DB::table('sales_models')
                    ->select('sales_models.*', 'customers.customer_name')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id');
        if($customer != ''){
            $sales = $sales->where('sales_models.customer_id', $customer);
        }
        $sales = $sales->whereBetween('sales_models.sale_date', [$from_date, $to_date]);
        $sales = $sales->get();
        return view('report.sales.sales_report', compact('sales','report_title'));
    }


    // purchase
    public function purchase_report_page()
    {
        $suppliers = DB::table('suppliers')->get();
        return view('report.purchase.purchase_report_page', compact('suppliers'));
    }
    public function purchase_report(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if($to_date == null || $to_date == ''){
            $to_date = $from_date;
        }
        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));
        $report_title="Purchase Report From $from_date to $to_date";
        $purchase = DB::table('purchas_models')
                    ->select('purchas_models.*', 'suppliers.supplier_name')
                    ->join('suppliers', 'purchas_models.supplier_id', '=', 'suppliers.id');
        if($supplier_id != ''){
            $purchase = $purchase->where('purchas_models.supplier_id', $supplier_id);
        }
        $purchase = $purchase->whereBetween('purchas_models.purchas_date', [$from_date, $to_date]);
        $purchase = $purchase->get();
        return view('report.purchase.purchase_report', compact('purchase','report_title'));
    }

}
