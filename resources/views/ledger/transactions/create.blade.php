@extends('layouts.default')

@section('title', 'Add New Transaction')

@section('content')
<section class="content-header">
    <h1>Add New Transaction</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="party_id">Party</label>
                    <select name="party_id" class="form-control" required>
                        @foreach($parties as $party)
                            <option value="{{ $party->id }}">{{ $party->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="transaction_type">Transaction Type</label>
                    <select name="transaction_type" class="form-control" required>
                        <option value="sale">Sale</option>
                        <option value="purchase">Purchase</option>
                        <option value="payment">Payment</option>
                        <option value="return">Return</option>
                        <option value="adjustment">Adjustment</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="bill_amount">Bill Amount</label>
                    <input type="number" name="bill_amount" class="form-control" step="0.01" value="0.00">
                </div>
                <div class="form-group">
                    <label for="paid_amount">Paid Amount</label>
                    <input type="number" name="paid_amount" class="form-control" step="0.01" value="0.00">
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" name="discount" class="form-control" step="0.01" value="0.00">
                </div>
                <div class="form-group">
                    <label for="returned_amount">Returned Amount</label>
                    <input type="number" name="returned_amount" class="form-control" step="0.01" value="0.00">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection