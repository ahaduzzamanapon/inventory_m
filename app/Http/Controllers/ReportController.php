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
