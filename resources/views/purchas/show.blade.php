@extends('layouts.default')

{{-- Page title --}}
@section('title')
Purchas Details @parent
@stop

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div aria-label="breadcrumb" class="card-breadcrumb mb-4">
        <h1 class="text-primary">Purchas Details</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
</section>

<div class="content">
    <div class="card shadow-lg p-4">
        <!-- Purchas and Supplier Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h3 class="text-primary">Purchas Information</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Purchas ID:</strong> {{ $purchas->purchas_id }}</li>
                    <li class="list-group-item"><strong>Purchas Date:</strong> {{ $purchas->purchas_date }}</li>
                    <li class="list-group-item"><strong>Reference No:</strong> {{ $purchas->reference_no }}</li>
                    <li class="list-group-item"><strong>Payment Status:</strong> <span class="badge badge-{{ $purchas->payment_status == 'Paid' ? 'success' : 'warning' }}">{{ $purchas->payment_status }}</span></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 class="text-primary">Supplier Information</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name:</strong> {{ $supplier->supplier_name }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $supplier->supplier_email }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $supplier->supplier_phone }}</li>
                    <li class="list-group-item"><strong>Address:</strong> {{ $supplier->supplier_address }}</li>
                </ul>
            </div>
        </div>

        <!-- Purchas Items -->
        <div class="mb-4">
            <h3 class="text-primary">Items Purchased</h3>
            <table class="table table-hover table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Item Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($PurchasItem as $item)
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ number_format($item->item_per_price, 2) }}</td>
                        <td>{{ $item->purchas_qty }}</td>
                        <td>{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Sub Total:</strong> {{ number_format($purchas->sub_total, 2) }}</li>
                <li class="list-group-item"><strong>Discount:</strong> {{ number_format($purchas->discount_amount, 2) }} ({{ $purchas->discount_per }}{{ $purchas->discount_status=='Percentage' ? '%' : '' }})</li>
                <li class="list-group-item"><strong>Tax:</strong> {{ number_format($purchas->tax_amount, 2) }} ({{ $purchas->tax_per }}{{ $purchas->tax_status=='Percentage' ? '%' : '' }})</li>
                <li class="list-group-item"><strong>Grand Total:</strong> {{ number_format($purchas->grand_total, 2) }}</li>
            </ul>
        </div>

        <!-- Payment Details -->
        <div class="mb-4">
            <h5 class="text-primary">Payment Details</h5>
            <table class="table table-hover table-bordered">
                <thead class="table-prymari">
                    <tr>
                        <th>Payment ID</th>
                        <th>Payment Date</th>
                        <th>Payment Method</th>
                        <th>Payment Amount</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($PurchasPayment as $payment)
                    <tr>
                        <td>{{ $payment->payment_id }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td>{{ number_format($payment->payment_amount, 2) }}</td>
                        <td><span class="badge badge-{{ $payment->payment_status == 'Paid' ? 'success' : 'warning' }}">{{ $payment->payment_status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Paid Amount:</strong> {{ number_format($purchas->payment_amount, 2) }}</li>
                <li class="list-group-item"><strong>Due Amount:</strong> {{ number_format($purchas->due_amount, 2) }}</li>
            </ul>
        </div>

        <!-- Back Button -->
        <div class="text-right">
            <a href="{{ route('purchas.purchas_list') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
