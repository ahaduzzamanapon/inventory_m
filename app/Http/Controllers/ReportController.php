<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function showReportPage()
    {
        $customers = DB::table('customers')->get();
        $suppliers = DB::table('suppliers')->get();
        return view('report.reports', compact('customers', 'suppliers'));
    }

    public function generateReport(Request $request)
    {

        $fromDate = date('Y-m-d', strtotime($request->input('from_date')));
        $toDate = date('Y-m-d', strtotime($request->input('to_date'))); 

        $type = $request->input('type');
        $supplier_id = $request->input('supplier_id');
        $customer_id = $request->input('customer_id');
        $query = null;
        $headers = [];
        $reportData = [];

        switch ($type) {
            case 'sales':
                $report_title = 'Sales Report from ' . $fromDate . ' to ' . $toDate;
                $query = DB::table('sales_models')
                    ->select('sales_models.sales_id', 'customers.customer_name', 'sales_models.grand_total as total_amount', 'sales_models.due_amount', 'sales_models.created_at')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->whereBetween('sales_models.sale_date', [$fromDate, $toDate]);
                if ($customer_id) $query->where('sales_models.customer_id', $customer_id);
                $headers = ['ID', 'Customer Name', 'Total Amount', 'Due Amount', 'Date'];
                $footer_data= DB::table('sales_models')
                    ->select(DB::raw('SUM(grand_total) as total_amount'), DB::raw('SUM(due_amount) as due_amount'))
                    ->whereBetween('sale_date', [$fromDate, $toDate])
                    ->first();
                $footers= ['Total', '', $footer_data->total_amount, $footer_data->due_amount, ''];

                break;
            case 'purchases':
                $report_title = 'Purchases Report from ' . $fromDate . ' to ' . $toDate;
                $query = DB::table('purchas_models')
                    ->select('purchas_models.purchas_id', 'suppliers.supplier_name', 'purchas_models.grand_total as total_amount', 'purchas_models.due_amount', 'purchas_models.purchas_date')
                    ->join('suppliers', 'purchas_models.supplier_id', '=', 'suppliers.id')
                    ->whereBetween('purchas_models.purchas_date', [$fromDate, $toDate]);
                if ($supplier_id) $query->where('purchas_models.supplier_id', $supplier_id);
                $headers = ['ID', 'Supplier Name', 'Total Amount', 'Due Amount', 'Date'];
                $footer_data= DB::table('purchas_models')
                    ->select(DB::raw('SUM(grand_total) as total_amount'), DB::raw('SUM(due_amount) as due_amount'))
                    ->whereBetween('purchas_date', [$fromDate, $toDate])
                    ->first();
                $footers= ['Total', '', $footer_data->total_amount, $footer_data->due_amount, ''];
                break;


            case 'stock':
                $report_title = 'Stock Report';
                $query = DB::table('items')
                    ->select('item_id', 'item_name', 'item_qty');

                $headers = ['ID', 'Item Name', 'Quantity'];
                $footers = [];
                break;

            case 'customer_due':
                $query = DB::table('sales_models')
                    ->select('sales_models.sales_id', 'customers.customer_name', 'sales_models.grand_total as total_amount', 'sales_models.due_amount', 'sales_models.created_at')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->where('sales_models.due_amount', '>', 0);
                $query->where('sales_models.customer_id', $customer_id);
                $report_title = 'Customer Due Report';
                $headers = ['ID', 'Customer Name', 'Total Amount', 'Due Amount', 'Date'];
                $footer_data= DB::table('sales_models')
                    ->select(DB::raw('SUM(grand_total) as total_amount'), DB::raw('SUM(due_amount) as due_amount'))
                    ->where('due_amount', '>', 0)
                    ->where('customer_id', $customer_id)
                    ->first();
                $footers= ['Total', '', $footer_data->total_amount, $footer_data->due_amount, ''];
                break;

            case 'supplier_due':
                $query = DB::table('purchas_models')
                    ->select('purchas_models.purchas_id', 'suppliers.supplier_name', 'purchas_models.grand_total as total_amount', 'purchas_models.due_amount', 'purchas_models.purchas_date')
                    ->join('suppliers', 'purchas_models.supplier_id', '=', 'suppliers.id')
                    ->where('purchas_models.due_amount', '>', 0);
                $query->where('purchas_models.supplier_id', $supplier_id);
                $report_title = 'Supplier Due Report';
                $headers = ['ID', 'Supplier Name', 'Total Amount', 'Due Amount', 'Date'];
                $footer_data= DB::table('purchas_models')
                    ->select(DB::raw('SUM(grand_total) as total_amount'), DB::raw('SUM(due_amount) as due_amount'))
                    ->where('due_amount', '>', 0)
                    ->where('supplier_id', $supplier_id)
                    ->first();
                $footers= ['Total', '', $footer_data->total_amount, $footer_data->due_amount, ''];
                break;
        }

        if ($query) {
            $reportData = $query->get();
        }

        return view('report.report_view', compact('reportData', 'headers', 'footers','report_title'));
    }
}
