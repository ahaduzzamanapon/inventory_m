<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class ReportController extends Controller
{
    public function generate(Request $request)
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
                $sales = DB::table('sales_models')->whereYear('sale_date', now()->year)->get();
                $purchases = DB::table('purchas_models')->whereYear('purchas_date', now()->year)->get();
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
                    'sales' => ['ID', 'Customer ID', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'],
                    'purchases' => ['ID', 'Purchas ID', 'Supplier ID', 'Purchas Date', 'Grand Total', 'Payment Amount', 'Due Amount'],
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
                $totalSales = DB::table('sales_models')->whereYear('sale_date', now()->year)->sum('grand_total');
                $totalExpenses = DB::table('logistic_bills')->whereYear('date', now()->year)->where('status', 'Approved')->sum('amount');
                $data = [
                    'totalSales' => $totalSales,
                    'totalExpenses' => $totalExpenses,
                    'netProfit' => $totalSales - $totalExpenses,
                ];
                $headers = ['Total Sales', 'Total Expenses', 'Net Profit'];
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
                $sales = DB::table('sales_models')->whereYear('sale_date', now()->year)->get();
                $purchases = DB::table('purchas_models')->whereYear('purchas_date', now()->year)->get();
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
                    'sales' => ['ID', 'Customer ID', 'Sale Date', 'Sub Total', 'Discount', 'Tax', 'Grand Total', 'Payment Status'],
                    'purchases' => ['ID', 'Purchas ID', 'Supplier ID', 'Purchas Date', 'Grand Total', 'Payment Amount', 'Due Amount'],
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
                $totalSales = DB::table('sales_models')->whereYear('sale_date', now()->year)->sum('grand_total');
                $totalExpenses = DB::table('logistic_bills')->whereYear('date', now()->year)->where('status', 'Approved')->sum('amount');
                $data = [
                    'totalSales' => $totalSales,
                    'totalExpenses' => $totalExpenses,
                    'netProfit' => $totalSales - $totalExpenses,
                ];
                $headers = ['Total Sales', 'Total Expenses', 'Net Profit'];
                $view = 'report.net_profit';
                break;
            default:
                return response('Report not found', 404);
        }

        $pdf = \PDF::loadView($view, compact('title', 'data', 'headers'));
        return $pdf->download($title . '.pdf');
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
          return view('report.account.account_report_page', compact('users'));
      }
      public function account_report(Request $request){
          $user_id = $request->user_id;
          $from_date = $request->from_date;
          $to_date = $request->to_date;
          $report_type = $request->report_type;
          if($to_date == null || $to_date == ''){
              $to_date = $from_date;
          }
          $from_date = date('Y-m-d', strtotime($from_date));
          $to_date = date('Y-m-d', strtotime($to_date));

          if ($report_type == 'petty_cash') {
            $pettyCashes = DB::table('pettycash')
                            ->select('pettycash.*', 'users.name as user_name')
                            ->join('users', 'pettycash.user_id', '=', 'users.id');
            if($user_id != ''){
                $pettyCashes = $pettyCashes->where('pettycash.user_id', $user_id);
            }
            $pettyCashes = $pettyCashes->whereBetween('pettycash.date', [$from_date, $to_date]);
            $pettyCashes = $pettyCashes->get();
            $report_title="Petty Cash Report From $from_date to $to_date";
            dd($pettyCashes);
            return view('report.account.petty_cash_report', compact('pettyCashes','report_title'));
          }
          if ($report_type == 'advance_cash') {
            $advanceCashes = DB::table('advanced_cash')
                            ->select('advanced_cash.*', 'users.name as user_name', 'members.member_name')
                            ->join('users', 'advanced_cash.user_id', '=', 'users.id')
                            ->join('members', 'advanced_cash.member_id', '=', 'members.id');
            if($user_id != ''){
                $advanceCashes = $advanceCashes->where('advanced_cash.user_id', $user_id);
            }
            $advanceCashes = $advanceCashes->whereBetween('advanced_cash.date', [$from_date, $to_date]);
            $advanceCashes = $advanceCashes->get();
            $report_title="Advance Cash Report From $from_date to $to_date";
            return view('report.account.advance_cash_report', compact('advanceCashes','report_title'));
          }
          if ($report_type == 'logistics_bill') {
            $logisticsBills = DB::table('logistic_bills')
                            ->select('logistic_bills.*', 'users.name as user_name')
                            ->join('users', 'logistic_bills.user_id', '=', 'users.id');
            if($user_id != ''){
                $logisticsBills = $logisticsBills->where('logistic_bills.user_id', $user_id);
            }
            $logisticsBills = $logisticsBills->whereBetween('logistic_bills.date', [$from_date, $to_date]);
            $logisticsBills = $logisticsBills->get();
            $report_title="Logistics Bill Report From $from_date to $to_date";
            return view('report.account.logistics_bill_report', compact('logisticsBills','report_title'));
          }
      }

}