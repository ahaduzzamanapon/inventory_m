@extends('layouts.default')

@section('title', 'Party Ledger')

@section('content')
<section class="content-header">
    <h1>Ledger for {{ $party->name }}</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">All Transactions</h5>
            <div class="card-tools">
                <a href="{{ route('transactions.create', ['party_id' => $party->id]) }}" class="btn btn-primary">Add New Transaction</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Bill Amount</th>
                        <th>Paid Amount</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->transaction_type }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->bill_amount }}</td>
                            <td>{{ $transaction->paid_amount }}</td>
                            <td>{{ $transaction->balance }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
