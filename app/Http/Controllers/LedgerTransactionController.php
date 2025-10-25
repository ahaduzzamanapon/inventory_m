<?php

namespace App\Http\Controllers;

use App\Models\LedgerTransaction;
use App\Models\Party;
use Illuminate\Http\Request;

class LedgerTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = LedgerTransaction::with('party')->get();
        return view('ledger.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parties = Party::all();
        return view('ledger.transactions.create', compact('parties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'party_id' => 'required|exists:parties,id',
            'date' => 'required|date',
            'transaction_type' => 'required|string',
            'description' => 'nullable|string',
            'bill_amount' => 'nullable|numeric',
            'paid_amount' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'returned_amount' => 'nullable|numeric',
        ]);

        $last_transaction = LedgerTransaction::where('party_id', $request->party_id)->latest()->first();
        $last_balance = $last_transaction ? $last_transaction->balance : Party::find($request->party_id)->opening_balance;

        $new_balance = $last_balance + ($request->bill_amount ?? 0) - ($request->paid_amount ?? 0) - ($request->discount ?? 0) - ($request->returned_amount ?? 0);

        LedgerTransaction::create(array_merge($request->all(), ['balance' => $new_balance]));

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LedgerTransaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
