@extends('layouts.default')

{{-- Page title --}}
@section('title')
Sales Details @parent
@stop

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    {{--<div aria-label="breadcrumb" class="card-breadcrumb mb-4">
        <h1 class="text-primary">Sales Details</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>--}}
</section>

<div class="content">
    <div class="card shadow-lg p-4">
        <!-- Sales and Customer Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h3 class="text-primary">Sales Information</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Sale ID:</strong> {{ $sales->sales_id }}</li>
                    <li class="list-group-item"><strong>Sale Date:</strong> {{ $sales->sale_date }}</li>
                    <li class="list-group-item"><strong>Reference No:</strong> {{ $sales->reference_no }}</li>
                    <li class="list-group-item"><strong>Payment Status:</strong> <span class="badge badge-{{ $sales->payment_status == 'Paid' ? 'success' : 'warning' }}">{{ $sales->payment_status }}</span></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 class="text-primary">Customer Information</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name:</strong> {{ $customer->customer_name }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $customer->customer_email }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $customer->customer_phone }}</li>
                    <li class="list-group-item"><strong>Address:</strong> {{ $customer->customer_address }}</li>
                </ul>
            </div>
        </div>

        <!-- Sales Items -->
        <div class="mb-4">
            <h3 class="text-primary">Items Sold</h3>
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
                    @foreach($SalesItem as $item)
                    <tr>
                        <td>
                            <?= get_item_name_by_id($item['item_id']) ?>
                            @if($item['item_serial'] !=null)
                            @php
                                $serials =  json_decode($item['item_serial']);
                                //dd($serials);
                                $item_serials=DB::table('item_serials')->whereIn('id', $serials)->get();
                                //dd($item_serials);
                                foreach ($item_serials as $serial) {
                                    echo $serial->item_serial_number.',';
                                }
                            @endphp
                            @endif
                        </td>
                        <td>{{ number_format($item->item_per_price, 2) }}</td>
                        <td>{{ $item->sales_qty }}</td>
                        <td>{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Sub Total:</strong> {{ number_format($sales->sub_total, 2) }}</li>
                <li class="list-group-item"><strong>Discount:</strong> {{ number_format($sales->discount_amount, 2) }} ({{ $sales->discount_per }}{{ $sales->discount_status=='Percentage' ? '%' : '' }})</li>
                <li class="list-group-item"><strong>Tax:</strong> {{ number_format($sales->tax_amount, 2) }} ({{ $sales->tax_per }}{{ $sales->tax_status=='Percentage' ? '%' : '' }})</li>
                <li class="list-group-item"><strong>Grand Total:</strong> {{ number_format($sales->grand_total, 2) }}</li>
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
                    @foreach($SalesPayment as $payment)
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
                <li class="list-group-item"><strong>Paid Amount:</strong> {{ number_format($sales->payment_amount, 2) }}</li>
                <li class="list-group-item"><strong>Due Amount:</strong> {{ number_format($sales->due_amount, 2) }}</li>
            </ul>
        </div>

        <!-- Back Button -->
        <div class="text-right">
            <a href="{{ route('sales.sales_list') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
