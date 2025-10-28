<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LedgerTransaction;
use Illuminate\Http\Request;

class LedgerReportController extends Controller
{
    public function generateReport(Request $request, Customer $customer)
    {
        $query = $customer->ledger_transactions();

        if ($request->from_date) {
            $query->where('date', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->where('date', '<=', $request->to_date);
        }

        $transactions = $query->orderBy('date')->get();

        return view('ledger.report.report_view', compact('customer', 'transactions'));
    }
}

