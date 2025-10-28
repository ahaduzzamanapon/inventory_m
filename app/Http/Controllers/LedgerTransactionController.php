<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LedgerTransaction;
use Illuminate\Http\Request;
use DB;

class LedgerTransactionController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('ledger.index', compact('customers'));
    }

    public function getTransactions(Customer $customer)
    {
        $transactions = $customer->ledger_transactions()->orderBy('date')->get();
        return response()->json([
            'transactions' => $transactions,
            'opening_balance' => $customer->opening_balance,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'transaction_type' => 'required|string',
            'description' => 'nullable|string',
            'bill_amount' => 'nullable|numeric',
            'paid_amount' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'returned_amount' => 'nullable|numeric',
            'payment_method' => 'nullable|string',
            'invoice_no' => 'nullable|string',
        ]);

        $last_transaction = LedgerTransaction::where('customer_id', $request->customer_id)->latest()->first();
        $last_balance = $last_transaction ? $last_transaction->balance : Customer::find($request->customer_id)->opening_balance;

        $new_balance = $last_balance + ($request->bill_amount ?? 0) - ($request->paid_amount ?? 0) - ($request->discount ?? 0) - ($request->returned_amount ?? 0);

        $transaction = LedgerTransaction::create(array_merge($request->all(), ['balance' => $new_balance]));

        return response()->json($transaction);
    }
    public function updateOpeningBalance(Request $request, Customer $customer)
    {
        $request->validate([
            'opening_balance' => 'required|numeric',
        ]);

        if ($customer->ledger_transactions()->count() == 0) {
            $customer->opening_balance = $request->opening_balance;
            $customer->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Cannot update opening balance when transactions exist.']);
    }
}
