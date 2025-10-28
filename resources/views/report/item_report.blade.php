@extends('layouts.default')

@section('title', 'Item Report')

@section('content')
<section class="content-header">
    <h1>Item Report for {{ $item->item_name }}</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $item->item_name }}</h5>
            <div class="card-tools">
                <button class="btn btn-primary" onclick="window.print()">Print</button>
            </div>
        </div>
        <div class="card-body">
            <h3>Sales</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->sale_date }}</td>
                            <td>{{ $sale->customer_name }}</td>
                            <td>{{ $sale->sales_qty }}</td>
                            <td>{{ $sale->item_per_price }}</td>
                            <td>{{ $sale->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="mt-4">Purchases</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->purchas_date }}</td>
                            <td>{{ $purchase->supplier_name }}</td>
                            <td>{{ $purchase->purchas_qty }}</td>
                            <td>{{ $purchase->item_per_price }}</td>
                            <td>{{ $purchase->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="summary mt-4">
                <h3>Summary</h3>
                <p><strong>Total Sales:</strong> {{ $sales->sum('total_price') }}</p>
                <p><strong>Total Purchases:</strong> {{ $purchases->sum('total_price') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
