@extends('layouts.default')

@section('title', 'Transactions')

@section('content')
<section class="content-header">
    <h1>Transactions</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">All Transactions</h5>
            <div class="card-tools">
                <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add New Transaction</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Party</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Bill Amount</th>
                        <th>Paid Amount</th>
                        <th>Balance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->party->name }}</td>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->transaction_type }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->bill_amount }}</td>
                            <td>{{ $transaction->paid_amount }}</td>
                            <td>{{ $transaction->balance }}</td>
                            <td>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection