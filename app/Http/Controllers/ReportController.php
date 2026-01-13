<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\Models\SalesModel;
use App\Models\PurchasModel;
use App\Models\LogisticBill;

class ReportController extends Controller
{
    public function generate(Request $request)
    {
        $title = $request->get('title');
        $data = [];
        $headers = [];
        $view = '';

        $from_date = date('Y-m-d', strtotime($request->get('from_date')));
        $to_date = date('Y-m-d', strtotime($request->get('to_date')));

        switch ($title) {
            case 'Monthly Sales':
                $data = DB::table('sales_models')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->whereBetween('sales_models.sale_date', [$from_date, $to_date])
                    ->select('customers.customer_name', 'sales_models.sale_date', 'sales_models.sub_total', 'sales_models.discount_amount', 'sales_models.tax_amount', 'sales_models.grand_total', 'sales_models.payment_status')
                    ->get();
                    //dd($data);
                $headers = ['Customer Name', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'];
                $view = 'report.pdf';
                break;
            case 'Monthly Expense':
                $data = DB::table('logistic_bills')
                    ->leftJoin('customers', 'logistic_bills.customer', '=', 'customers.id')
                    ->whereBetween('logistic_bills.date', [$from_date, $to_date])
                    ->where('logistic_bills.status', 'Approved')
                    ->select('logistic_bills.date', 'logistic_bills.Sale', 'logistic_bills.location', 'customers.customer_name', 'logistic_bills.amount', 'logistic_bills.note', 'logistic_bills.status')
                    ->get();
                $headers = ['Date', 'Sale', 'Location', 'Customer', 'Amount', 'Note', 'Status'];
                $view = 'report.pdf';
                break;
            case 'Total Liability':
                $data = DB::table('purchas_models')
                    ->join('suppliers', 'purchas_models.supplier_id', '=', 'suppliers.id')
                    ->where('purchas_models.due_amount', '>', 0)
                    ->whereBetween('purchas_models.purchas_date', [$from_date, $to_date])
                    ->select('purchas_models.purchas_id', 'suppliers.supplier_name', 'purchas_models.purchas_date', 'purchas_models.grand_total', 'purchas_models.payment_amount', 'purchas_models.due_amount')
                    ->get();
                $headers = ['Purchas ID', 'Supplier Name', 'Purchas Date', 'Grand Total', 'Payment Amount', 'Due Amount'];
                $view = 'report.pdf';
                break;
            case 'Running Petty cash':
                $credit = DB::table('pettycash')
                    ->join('accountledgers', 'pettycash.account_ledgers', '=', 'accountledgers.id')
                    ->where('pettycash.account_description', 'Credit')
                    ->whereBetween('pettycash.date', [$from_date, $to_date])
                    ->where('pettycash.status', 'Approved')
                    ->select('pettycash.date', 'accountledgers.name', 'pettycash.amount', 'pettycash.status')
                    ->get();
                $debit = DB::table('pettycash')
                    ->join('accountledgers', 'pettycash.account_ledgers', '=', 'accountledgers.id')
                    ->where('pettycash.account_description', 'Debit')
                    ->whereBetween('pettycash.date', [$from_date, $to_date])
                    ->where('pettycash.status', 'Approved')
                    ->select('pettycash.date', 'accountledgers.name', 'pettycash.amount', 'pettycash.status')
                    ->get();
                $totalCredit = $credit->sum('amount');
                $totalDebit = $debit->sum('amount');
                $runningPettyCash = $totalCredit - $totalDebit;
                $headers = ['Date', 'Account Ledger', 'Amount', 'Status'];
                $view = 'report.petty_cash_ledger';
                $data = [
                    'credit' => $credit,
                    'debit' => $debit,
                    'totalCredit' => $totalCredit,
                    'totalDebit' => $totalDebit,
                    'runningPettyCash' => $runningPettyCash,
                ];
                break;
            case 'Total Advance':
                $data = DB::table('advanced_cash')
                    ->join('users', 'advanced_cash.member_id', '=', 'users.id')
                    ->where('advanced_cash.status', 'Approved')
                    ->whereBetween('advanced_cash.created_at', [$from_date, $to_date])
                    ->select('users.name', 'advanced_cash.purpose', 'advanced_cash.amount', 'advanced_cash.status')
                    ->get();
                $headers = ['Member Name', 'Purpose', 'Amount', 'Status'];
                $view = 'report.pdf';
                break;
            case 'Total Item':
                $data = DB::table('items')
                    ->leftJoin('categories', 'items.item_category', '=', 'categories.id')
                    ->leftJoin('subcategorys', 'items.item_sub_category', '=', 'subcategorys.id')                    
                    ->select('items.item_id', 'items.item_name', 'categories.Name as category_name', 'subcategorys.SubCategoryName as subcategory_name', 'items.item_qty', 'items.item_purchase_price', 'items.item_sale_price')
                    ->get();
                $headers = ['Item ID', 'Item Name', 'Category', 'Sub Category', 'Qty', 'Purchase Price', 'Sale Price'];
                $view = 'report.pdf';
                break;
            case 'Total Product Value':
                $data = DB::table('items')->select('item_name', 'item_qty', 'item_purchase_price')->get();
                $headers = ['Item Name', 'Qty', 'Purchase Price', 'Total Value'];
                $view = 'report.product_value';
                break;
            case 'Total sales Due':
                $data = DB::table('sales_models')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->where('sales_models.due_amount', '>', 0)
                    ->whereBetween('sales_models.sale_date', [$from_date, $to_date])
                    ->select('sales_models.sales_id', 'customers.customer_name', 'sales_models.sale_date', 'sales_models.grand_total', 'sales_models.payment_amount', 'sales_models.due_amount')
                    ->get();
                $headers = ['Sales ID', 'Customer Name', 'Sale Date', 'Grand Total', 'Payment Amount', 'Due Amount'];
                $view = 'report.pdf';
                break;
            case 'Total Yearly Profit':
                $sales = SalesModel::with('customer')->whereBetween('sale_date', [$from_date, $to_date])->get();
                $purchases = PurchasModel::with('supplier')->whereBetween('purchas_date', [$from_date, $to_date])->get();
                $totalSales = $sales->sum('grand_total');
                $totalPurchases = $purchases->sum('grand_total');
                $data = [
                    'sales' => $sales,
                    'purchases' => $purchases,
                    'totalSales' => $totalSales,
                    'totalPurchases' => $totalPurchases,
                    'totalProfit' => $totalSales - $totalPurchases,
                ];
                $headers = [
                    'sales' => ['ID', 'Customer Name', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'],
                    'purchases' => ['ID', 'Purchas ID', 'Supplier Name', 'Purchas Date', 'Grand Total', 'Payment Amount', 'Due Amount'],
                ];
                $view = 'report.yearly_profit';
                break;
            case 'Total Yearly Sales':
                $data = DB::table('sales_models')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->whereBetween('sale_date', [$from_date, $to_date])
                    ->select('customers.customer_name', 'sales_models.sale_date', 'sales_models.sub_total', 'sales_models.discount_amount', 'sales_models.tax_amount', 'sales_models.grand_total', 'sales_models.payment_status')
                    ->get();
                $headers = ['Customer Name', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'];
                $view = 'report.pdf';
                break;
            case 'Total Yearly Expenses':
                $data = DB::table('logistic_bills')
                    ->leftJoin('customers', 'logistic_bills.customer', '=', 'customers.id')
                    ->whereBetween('logistic_bills.date', [$from_date, $to_date])
                    ->where('logistic_bills.status', 'Approved')
                    ->select('logistic_bills.date', 'logistic_bills.Sale', 'logistic_bills.location', 'customers.customer_name', 'logistic_bills.amount', 'logistic_bills.note', 'logistic_bills.status')
                    ->get();
                $headers = ['Date', 'Sale', 'Location', 'Customer', 'Amount', 'Note', 'Status'];
                $view = 'report.pdf';
                break;
            case 'Total Net Profit':
                $sales = SalesModel::with('customer')->get();
                $expenses = LogisticBill::with('customer')->where('status', 'Approved')->get();
                $totalSales = $sales->sum('grand_total');
                $totalExpenses = $expenses->sum('amount');
                $data = [
                    'sales' => $sales,
                    'expenses' => $expenses,
                    'totalSales' => $totalSales,
                    'totalExpenses' => $totalExpenses,
                    'netProfit' => $totalSales - $totalExpenses,
                ];
                $headers = [
                    'sales' => ['ID', 'Customer Name', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'],
                    'expenses' => ['ID', 'Date', 'Sale', 'Location', 'Customer', 'Amount', 'Note', 'Status'],
                ];
                $view = 'report.net_profit';
                break;
            default:
                return response('Report not found', 404);
        }

        return view($view, compact('title', 'data', 'headers'));
    }

    public function downloadPdf(Request $request)
    {
        $title = $request->get('title');
        $data = [];
        $headers = [];
        $view = '';

        switch ($title) {
            case 'Monthly Sales':
                $data = DB::table('sales_models')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->whereMonth('sale_date', now()->month)
                    ->select('customers.customer_name', 'sales_models.sale_date', 'sales_models.sub_total', 'sales_models.discount_amount', 'sales_models.tax_amount', 'sales_models.grand_total', 'sales_models.payment_status')
                    ->get();
                $headers = ['Customer Name', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'];
                $view = 'report.pdf';
                break;
            case 'Monthly Expense':
                $data = DB::table('logistic_bills')
                    ->leftJoin('customers', 'logistic_bills.customer', '=', 'customers.id')
                    ->whereMonth('logistic_bills.date', now()->month)
                    ->where('logistic_bills.status', 'Approved')
                    ->select('logistic_bills.date', 'logistic_bills.Sale', 'logistic_bills.location', 'customers.customer_name', 'logistic_bills.amount', 'logistic_bills.note', 'logistic_bills.status')
                    ->get();
                $headers = ['Date', 'Sale', 'Location', 'Customer', 'Amount', 'Note', 'Status'];
                $view = 'report.pdf';
                break;
            case 'Total Liability':
                $data = DB::table('purchas_models')
                    ->join('suppliers', 'purchas_models.supplier_id', '=', 'suppliers.id')
                    ->where('purchas_models.due_amount', '>', 0)
                    ->select('purchas_models.purchas_id', 'suppliers.supplier_name', 'purchas_models.purchas_date', 'purchas_models.grand_total', 'purchas_models.payment_amount', 'purchas_models.due_amount')
                    ->get();
                $headers = ['Purchas ID', 'Supplier Name', 'Purchas Date', 'Grand Total', 'Payment Amount', 'Due Amount'];
                $view = 'report.pdf';
                break;
            case 'Running Petty cash':
                $credit = DB::table('pettycash')
                    ->join('accountledgers', 'pettycash.account_ledgers', '=', 'accountledgers.id')
                    ->where('pettycash.account_description', 'Credit')
                    ->where('pettycash.status', 'Approved')
                    ->select('pettycash.date', 'accountledgers.name', 'pettycash.amount', 'pettycash.status')
                    ->get();
                $debit = DB::table('pettycash')
                    ->join('accountledgers', 'pettycash.account_ledgers', '=', 'accountledgers.id')
                    ->where('pettycash.account_description', 'Debit')
                    ->where('pettycash.status', 'Approved')
                    ->select('pettycash.date', 'accountledgers.name', 'pettycash.amount', 'pettycash.status')
                    ->get();
                $totalCredit = $credit->sum('amount');
                $totalDebit = $debit->sum('amount');
                $runningPettyCash = $totalCredit - $totalDebit;
                $headers = ['Date', 'Account Ledger', 'Amount', 'Status'];
                $view = 'report.petty_cash_ledger';
                $data = [
                    'credit' => $credit,
                    'debit' => $debit,
                    'totalCredit' => $totalCredit,
                    'totalDebit' => $totalDebit,
                    'runningPettyCash' => $runningPettyCash,
                ];
                break;
            case 'Total Advance':
                $data = DB::table('advanced_cash')
                    ->join('users', 'advanced_cash.member_id', '=', 'users.id')
                    ->where('advanced_cash.status', 'Approved')
                    ->select('users.name', 'advanced_cash.purpose', 'advanced_cash.amount', 'advanced_cash.status')
                    ->get();
                $headers = ['Member Name', 'Purpose', 'Amount', 'Status'];
                $view = 'report.pdf';
                break;
            case 'Total Item':
                $data = DB::table('items')
                    ->leftJoin('categories', 'items.item_category', '=', 'categories.id')
                    ->leftJoin('subcategorys', 'items.item_sub_category', '=', 'subcategorys.id')
                    ->select('items.item_id', 'items.item_name', 'categories.Name as category_name', 'subcategorys.SubCategoryName as subcategory_name', 'items.item_qty', 'items.item_purchase_price', 'items.item_sale_price')
                    ->get();
                $headers = ['Item ID', 'Item Name', 'Category', 'Sub Category', 'Qty', 'Purchase Price', 'Sale Price'];
                $view = 'report.pdf';
                break;
            case 'Total Product Value':
                $data = DB::table('items')->select('item_name', 'item_qty', 'item_purchase_price')->get();
                $headers = ['Item Name', 'Qty', 'Purchase Price', 'Total Value'];
                $view = 'report.product_value';
                break;
            case 'Total sales Due':
                $data = DB::table('sales_models')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->where('sales_models.due_amount', '>', 0)
                    ->select('sales_models.sales_id', 'customers.customer_name', 'sales_models.sale_date', 'sales_models.grand_total', 'sales_models.payment_amount', 'sales_models.due_amount')
                    ->get();
                $headers = ['Sales ID', 'Customer Name', 'Sale Date', 'Grand Total', 'Payment Amount', 'Due Amount'];
                $view = 'report.pdf';
                break;
            case 'Total Yearly Profit':
                $sales = SalesModel::with('customer')->whereYear('sale_date', now()->year)->get();
                $purchases = PurchasModel::with('supplier')->whereYear('purchas_date', now()->year)->get();
                $totalSales = $sales->sum('grand_total');
                $totalPurchases = $purchases->sum('grand_total');
                $data = [
                    'sales' => $sales,
                    'purchases' => $purchases,
                    'totalSales' => $totalSales,
                    'totalPurchases' => $totalPurchases,
                    'totalProfit' => $totalSales - $totalPurchases,
                ];
                $headers = [
                    'sales' => ['ID', 'Customer Name', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'],
                    'purchases' => ['ID', 'Purchas ID', 'Supplier Name', 'Purchas Date', 'Grand Total', 'Payment Amount', 'Due Amount'],
                ];
                $view = 'report.yearly_profit';
                break;
            case 'Total Yearly Sales':
                $data = DB::table('sales_models')
                    ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
                    ->whereYear('sale_date', now()->year)
                    ->select('customers.customer_name', 'sales_models.sale_date', 'sales_models.sub_total', 'sales_models.discount_amount', 'sales_models.tax_amount', 'sales_models.grand_total', 'sales_models.payment_status')
                    ->get();
                $headers = ['Customer Name', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'];
                $view = 'report.pdf';
                break;
            case 'Total Yearly Expenses':
                $data = DB::table('logistic_bills')
                    ->leftJoin('customers', 'logistic_bills.customer', '=', 'customers.id')
                    ->whereYear('logistic_bills.date', now()->year)
                    ->where('logistic_bills.status', 'Approved')
                    ->select('logistic_bills.date', 'logistic_bills.Sale', 'logistic_bills.location', 'customers.customer_name', 'logistic_bills.amount', 'logistic_bills.note', 'logistic_bills.status')
                    ->get();
                $headers = ['Date', 'Sale', 'Location', 'Customer', 'Amount', 'Note', 'Status'];
                $view = 'report.pdf';
                break;
            case 'Total Net Profit':
                $sales = SalesModel::with('customer')->get();
                $expenses = LogisticBill::with('customer')->where('status', 'Approved')->get();
                $totalSales = $sales->sum('grand_total');
                $totalExpenses = $expenses->sum('amount');
                $data = [
                    'sales' => $sales,
                    'expenses' => $expenses,
                    'totalSales' => $totalSales,
                    'totalExpenses' => $totalExpenses,
                    'netProfit' => $totalSales - $totalExpenses,
                ];
                $headers = [
                    'sales' => ['ID', 'Customer Name', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'],
                    'expenses' => ['ID', 'Date', 'Sale', 'Location', 'Customer', 'Amount', 'Note', 'Status'],
                ];
                $view = 'report.net_profit';
                break;
            default:
                return response('Report not found', 404);
        }

        $pdf = \PDF::loadView($view, compact('title', 'data', 'headers'));
        return $pdf->download($title . '.pdf');
    }

    public function itemReport($id)
    {
        $item = DB::table('items')->find($id);
        $sales = collect(DB::table('sales_item_models')
            ->join('sales_models', 'sales_item_models.sale_id', '=', 'sales_models.id')
            ->join('customers', 'sales_models.customer_id', '=', 'customers.id')
            ->where('sales_item_models.item_id', $id)
            ->select('sales_models.sale_date', 'customers.customer_name', 'sales_item_models.sales_qty', 'sales_item_models.item_per_price', 'sales_item_models.total_price')
            ->get());

        $purchases = collect(DB::table('purchas_item_models')
            ->join('purchas_models', 'purchas_item_models.purchas_id', '=', 'purchas_models.id')
            ->join('suppliers', 'purchas_models.supplier_id', '=', 'suppliers.id')
            ->where('purchas_item_models.item_id', $id)
            ->select('purchas_models.purchas_date', 'suppliers.supplier_name', 'purchas_item_models.purchas_qty', 'purchas_item_models.item_per_price', 'purchas_item_models.total_price')
            ->get());

        return view('report.item_report', compact('item', 'sales', 'purchases'));
    }

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


      // account_report_page
      public function account_report_page()
      {
          $users = DB::table('users')->get();
          $ledgers = DB::table('accountledgers')->get();
          return view('report.account.account_report_page', compact('users', 'ledgers'));
      }

      public function account_report(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if($to_date == null || $to_date == ''){
            $to_date = $from_date;
        }
        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));
        $user_id = $request->user_id;
        $report_type = $request->report_type;
        $report_title = ucwords(str_replace('_', ' ', $report_type)). " Report From $from_date to $to_date";

        $data = [];

        switch ($report_type) {
            case 'petty_cash':
                $query = DB::table('pettycash')
                    ->join('accountledgers', 'pettycash.account_ledgers', '=', 'accountledgers.id')
                    ->select('pettycash.*', 'accountledgers.name as ledger_name');
                if($request->ledger_id != ''){
                    $query = $query->where('pettycash.account_ledgers', $request->ledger_id);
                }
                $data = $query->whereBetween('pettycash.date', [$from_date, $to_date])->get();
                break;
            case 'advance_cash':
                $query = DB::table('advanced_cash')
                    ->join('users', 'advanced_cash.member_id', '=', 'users.id')
                    ->select('advanced_cash.*', 'users.name as user_name', 'advanced_cash.created_at as date');
                if($user_id != ''){
                    $query = $query->where('advanced_cash.member_id', $user_id);
                }
                $data = $query->whereBetween('advanced_cash.created_at', [$from_date, $to_date])->get();
                break;
            case 'logistics_bill':
                $query = DB::table('logistic_bills')
                    ->join('users', 'logistic_bills.member_id', '=', 'users.id')
                    ->select('logistic_bills.*', 'users.name as user_name');
                if($user_id != ''){
                    $query = $query->where('logistic_bills.member_id', $user_id);
                }
                $data = $query->whereBetween('logistic_bills.date', [$from_date, $to_date])->get();
                break;
            case 'salary':
                $query = DB::table('salaries')
                    ->join('users', 'salaries.user_id', '=', 'users.id')
                    ->select('salaries.*', 'users.name as user_name', 'salaries.created_at as date');
                if($user_id != ''){
                    $query = $query->where('salaries.user_id', $user_id);
                }
                $data = $query->whereBetween('salaries.created_at', [$from_date, $to_date])->get();
                break;
            case 'bonuses':
                $query = DB::table('bonuses')
                    ->join('users', 'bonuses.user_id', '=', 'users.id')
                    ->select('bonuses.*', 'users.name as user_name', 'bonuses.created_at as date');
                if($user_id != ''){
                    $query = $query->where('bonuses.user_id', $user_id);
                }
                $data = $query->whereBetween('bonuses.created_at', [$from_date, $to_date])->get();
                break;
            case 'commission':
                $query = DB::table('comissions')
                    ->join('users', 'comissions.employee', '=', 'users.id')
                    ->select('comissions.*', 'users.name as user_name');
                if($user_id != ''){
                    $query = $query->where('comissions.employee', $user_id);
                }
                $data = $query->whereBetween('comissions.date', [$from_date, $to_date])->get();
                break;
        }

        return view('report.account.'.$report_type, compact('data', 'report_title'));
    }

    public function attendance_report_page()
    {
        $users = DB::table('users')->get();
        return view('report.hrm.attendance_report_page', compact('users'));
    }

    public function attendance_report(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if($to_date == null || $to_date == ''){
            $to_date = $from_date;
        }
        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));
        $user_ids = $request->user_id; // This will now be an array
        $report_title = "Attendance Report From $from_date to $to_date";

        $query = DB::table('attendences')
            ->join('users', 'attendences.emp_id', '=', 'users.id')
            ->select('attendences.*', 'users.name as user_name');
        if(!empty($user_ids)){
            $query = $query->whereIn('attendences.emp_id', $user_ids);
        }
        $data = $query->whereBetween('attendences.date', [$from_date, $to_date])->get()->groupBy('user_name');

        return view('report.hrm.attendance_report', compact('data', 'report_title'));
    }

    

}
