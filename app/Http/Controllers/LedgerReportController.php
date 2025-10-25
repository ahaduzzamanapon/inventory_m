<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Party;
use App\Models\LedgerTransaction;

class LedgerReportController extends Controller
{
    public function showReportForm()
    {
        $parties = Party::all();
        return view('ledger.report.form', compact('parties'));
    }

    public function generateReport(Request $request)
    {
        $party = Party::findOrFail($request->party_id);
        $query = LedgerTransaction::where('party_id', $request->party_id);

        if ($request->from_date) {
            $query->where('date', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->where('date', '<=', $request->to_date);
        }

        $transactions = $query->get();

        return view('ledger.report.report_view', compact('party', 'transactions'));
    }

    public function generatePartyReport(Party $party)
    {
        $transactions = $party->ledger_transactions;
        return view('ledger.report.report_view', compact('party', 'transactions'));
    }
}

