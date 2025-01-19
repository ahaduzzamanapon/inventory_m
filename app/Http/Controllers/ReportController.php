<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function showReportPage()
    {
        $companies = DB::table('companies')->get();
        return view('reports', compact('companies'));
    }

    public function generateReport(Request $request)
    {
        $companies = DB::table('companies')->get();

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $type = $request->input('type');
        $company = $request->input('company');

        $query = null;
        $headers = [];
        $reportData = [];

        switch ($type) {
            case 'sales':
                $query = DB::table('sales_models')
                    ->select('sales_models.id', 'customers.customer_name', 'sales_models.grand_total as total_amount', 'sales_models.due_amount', 'sales_models.created_at')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->whereBetween('sales_models.created_at', [$fromDate, $toDate]);
                if ($company) $query->where('sales_models.company_id', $company);
                $headers = ['ID', 'Customer Name', 'Total Amount', 'Due Amount', 'Date'];
                break;

            case 'expenses':
                $query = DB::table('expenses')
                    ->select('id', 'description', 'amount', 'created_at')
                    ->whereBetween('created_at', [$fromDate, $toDate]);
                $headers = ['ID', 'Description', 'Amount', 'Date'];
                break;

            case 'purchases':
                $query = DB::table('purchases')
                    ->select('id', 'supplier_name', 'total_amount', 'created_at')
                    ->whereBetween('created_at', [$fromDate, $toDate]);
                $headers = ['ID', 'Supplier Name', 'Total Amount', 'Date'];
                break;

            case 'income':
                $query = DB::table('incomes')
                    ->select('id', 'source', 'amount', 'created_at')
                    ->whereBetween('created_at', [$fromDate, $toDate]);
                $headers = ['ID', 'Source', 'Amount', 'Date'];
                break;

            case 'stock':
                $query = DB::table('items')
                    ->select('id', 'name', 'stock_quantity', 'stock_value')
                    ->get();
                $headers = ['ID', 'Item Name', 'Quantity', 'Value'];
                break;

            case 'customer_due':
                $query = DB::table('customers')
                    ->select('id', 'name', 'due_amount')
                    ->get();
                $headers = ['ID', 'Customer Name', 'Due Amount'];
                break;

            case 'supplier_due':
                $query = DB::table('suppliers')
                    ->select('id', 'name', 'due_amount')
                    ->get();
                $headers = ['ID', 'Supplier Name', 'Due Amount'];
                break;
        }

        if ($query) {
            $reportData = $query->get();
        }

        return view('reports', compact('reportData', 'headers', 'companies'));
    }
}
