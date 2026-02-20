<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LedgerTransaction;
use App\Models\Organization;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DB;

class LedgerTransactionController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('ledger.index', compact('organizations'));
    }

    public function getTransactions(Request $request)
    {
        $query = LedgerTransaction::with(['customer', 'supplier', 'sale', 'purchase']);
        $opening_balance = 0;

        if ($request->has('customer_id') && !empty($request->customer_id)) {
            $query->where('customer_id', $request->customer_id);
            $opening_balance = Customer::find($request->customer_id)->opening_balance ?? 0;
        } elseif ($request->has('supplier_id') && !empty($request->supplier_id)) {
            $query->where('supplier_id', $request->supplier_id);
            $opening_balance = 0;
        } elseif ($request->has('organization_id') && !empty($request->organization_id)) {
            $organization = Organization::find($request->organization_id);
            if ($organization) {
                $customerIds = $organization->customers->pluck('id');
                $supplierIds = $organization->suppliers->pluck('id');

                $query->where(function ($q) use ($customerIds, $supplierIds, $request) {
                    $q->whereIn('customer_id', $customerIds)
                        ->orWhereIn('supplier_id', $supplierIds)
                        ->orWhere('organization_id', $request->organization_id);
                });

                // Calculate opening balance for organization (sum of customers opening balances + organization opening balance)
                $opening_balance = $organization->opening_balance + $organization->customers->sum('opening_balance');
            }
        } else {
            $opening_balance = 0;
        }

        $transactions = $query->orderBy('date')->orderBy('id')->get();

        $formatted_transactions = [];
        $balance = $opening_balance;

        foreach ($transactions as $transaction) {

            $sales_amount = '';
            $purchase_amount = '';
            $receivable_amount = '';
            $payable_amount = '';

            if ($transaction->transaction_type == 'sales') {
                $sales_amount = $transaction->amount;
                $balance += $transaction->amount;
            } elseif ($transaction->transaction_type == 'purchase') {
                $purchase_amount = $transaction->amount;
                $balance -= $transaction->amount;
            } elseif ($transaction->transaction_type == 'payment' && $transaction->customer_id) {
                $receivable_amount = $transaction->amount;
                $balance += $transaction->amount;
            } elseif ($transaction->transaction_type == 'payment' && $transaction->supplier_id) {
                $payable_amount = $transaction->amount;
                $balance -= $transaction->amount;
            } elseif ($transaction->transaction_type == 'receivable') {
                $receivable_amount = $transaction->amount;
                $balance -= $transaction->amount;
            } elseif ($transaction->transaction_type == 'payable') {
                $payable_amount = $transaction->amount;
                $balance += $transaction->amount;
            }

            $formatted_transactions[] = [
                'date' => date('d/m/Y', strtotime($transaction->date)),
                'description' => $transaction->description ?? $transaction->transaction_type,
                'sales' => $sales_amount,
                'purchase' => $purchase_amount,
                'receivable' => $receivable_amount,
                'payable' => $payable_amount,
                'balance' => number_format($balance, 2),
            ];
        }

        return response()->json([
            'transactions' => $formatted_transactions,
            'opening_balance' => $opening_balance, // Send raw number, let JS format it
        ]);
    }

    public function getMembers($organization_id)
    {
        $organization = Organization::findOrFail($organization_id);
        $customers = $organization->customers()->select('id', 'customer_name as name')->get()->map(function ($item) {
            $item->type = 'customer';
            return $item;
        });
        $suppliers = $organization->suppliers()->select('id', 'supplier_name as name')->get()->map(function ($item) {
            $item->type = 'supplier';
            return $item;
        });

        return response()->json($customers->concat($suppliers));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'transaction_type' => 'required|in:receivable,payable',
            'organization_id' => 'required|exists:organizations,id',
            'description' => 'nullable|string',
        ]);

        $data = [
            'organization_id' => $request->organization_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'transaction_type' => $request->transaction_type, // Save actual type: receivable or payable
            'description' => $request->description,
            'balance' => 0,
        ];

        // If member_id provided (optional now), prevent it, or just ignore it as per user request to remove it.
        // We will just save organization_id and type.

        $transaction = LedgerTransaction::create($data);

        return response()->json(['success' => true, 'transaction' => $transaction]);
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
