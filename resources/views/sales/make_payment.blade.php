@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Make Payment @parent
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
                        <li class="list-group-item"><strong>Payment Status:</strong> <span
                                class="badge badge-{{ $sales->payment_status == 'Paid' ? 'success' : 'warning' }}">{{ $sales->payment_status }}</span>
                        </li>
                        <li class="list-group-item"><strong>Total ammount:</strong> {{ $sales->grand_total }}</li>
                        <li class="list-group-item"><strong>Note:</strong> {{ $sales->sale_note }}</li>
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
                <h5 class="text-primary">Previous Payment Details</h5>
                <table class="table table-hover table-bordered">
                    <thead class="table-prymari">
                        <tr>
                            <th>Payment ID</th>
                            <th>Payment Date</th>
                            <th>Payment Method</th>
                            <th>Cheque No</th>
                            <th>Payment Amount</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($SalesPayment as $payment)
                            <tr>
                                <td>{{ $payment->payment_id }}</td>
                                <td>{{ $payment->payment_date }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ $payment->cheque_number }}</td>
                                <td>{{ number_format($payment->payment_amount, 2) }}</td>
                                <td><span>
                                        {{ $payment->payment_status }}
                                        </span>
                                        @if($payment->payment_status == 'Pending')
                                            @if(can('approve_payment'))
                                            <a href="{{ url('approve_payment/' . $payment->id) }}" class="btn btn-primary btn-sm">Approve</a>
                                            @endif
                                            @if(can('cheque_return'))
                                            <a href="{{ url('cheque_return/' . $payment->id) }}" class="btn btn-danger btn-sm">Cheque return</a>
                                            @endif
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Paid Amount:</strong>
                        {{ number_format($sales->payment_amount, 2) }}</li>
                    <li class="list-group-item"><strong>Due Amount:</strong> {{ number_format($sales->due_amount, 2) }}
                    </li>
                </ul>
            </div>
            {!! Form::open(['route' => ['sales.payment.store'], 'method' => 'POST']) !!}
            <input type="hidden" name="sales_id" value="{{ $sales->id }}">
            <input type="hidden" name="previous_due_amount" id="previous_due_amount" value="{{ $sales->due_amount }}">
            <div class="col-md-12">
                <h1>Make Payment</h1>
                <table class="table table-light table-hover table-bordered table-striped col-md-12">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Payment Method</th>
                            <th>Chaque No</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                            <th>Action <a class="btn btn-primary" onclick="addPaymentRow()"><i class="fa fa-plus"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="payment_table_body"></tbody>
                </table>
                <div>
                    <table class="table table-bordered col-md-6">
                        <tbody>
                            <tr>
                                <th>Total Payment:</th>
                                <td><input type="text" name="total_payment" id="total_payment"
                                        class="form-control text-right" readonly value="0"></td>
                            </tr>
                            <tr>
                                <th>Due:</th>
                                <td><input type="text" name="due" id="due" class="form-control text-right"
                                        readonly value="0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group col-sm-12" style="text-align-last: right;">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('subCategories.index') }}" class="btn btn-danger">Cancel</a>
            </div>
            {!! Form::close() !!}
            @section('footer_scripts')
            <script>
                var paymentMethods = @json($paymentMethods);
                var create_payment_id_sales = '{{ create_payment_id_sales() }}'; //Pay ID-00000287
                function addPaymentRow() {
                    var paymentMethodOptions = paymentMethods.map(function(paymentMethod) {
                        return '<option value="' + paymentMethod.id + '">' + paymentMethod.method_name + '</option>';
                    }).join('');
                    var paymentTableBody = document.getElementById('payment_table_body');
                    var lastRow = paymentTableBody.lastChild;
                    var lastRowPaymentId = lastRow ? lastRow.querySelector('.payment_id') ? lastRow.querySelector('.payment_id').value : null : null;
                    if (!lastRowPaymentId) {
                        newId = create_payment_id_sales;
                    } else {
                        var regex = /^Pay ID-\d+/;
                        var match = lastRowPaymentId.match(regex);
                        var newId;
                        if (match) {
                            var newNumber = parseInt(match[0].replace(/^Pay ID-/, '')) + 1;
                            newId = 'Pay ID-' + newNumber.toString().padStart(8, '0');
                        } else {
                            newId = 'Pay ID-' + '00000001';
                        }
                    }
                  
                    var newRow = document.createElement('tr');
                    newRow.innerHTML = '<td><input type="text"  name="payment_id[]" value="' + newId +
                        '" class="form-control payment_id"></td>' +
                        '<td><select name="payment_method_id[]" required class="form-control">' + paymentMethodOptions + '</select></td>' +
                        '<td><input type="text" name="Cheque_number[]" class="form-control" required></td>' +

                        '<td><input type="date" name="payment_date[]" value="{{ date('Y-m-d') }}" class="form-control" required></td>' +
                        '<td><input type="text" name="payment_amount[]" required value="0" class="form-control text-right payment_amount" onkeyup="calculatePaymentTotal()"></td>' +
                        '<td><a class="btn btn-danger" onclick="removePaymentRow(this)"><i class="fa fa-trash"></i></a></td>';
                    paymentTableBody.appendChild(newRow);

                }
                function removePaymentRow(button) {
                    var row = button.parentNode.parentNode;
                    row.parentNode.removeChild(row);
                }
                function calculatePaymentTotal() {
                    var total = 0;
                    $('.payment_amount').each(function() {
                        total += parseFloat($(this).val());
                    })
                    if (isNaN(total)) {
                        total = 0;
                    }
                    if (total < 0) {
                        total = 0;
                    }
                    if (total > parseFloat(document.getElementById('previous_due_amount').value)) {
                        $('.payment_amount').each(function() {
                            $(this).val(0);
                        });
                        total = 0;
                        alert('Payment amount cannot be greater than grand total');
                    }
                    document.getElementById('total_payment').value = total.toFixed(2);
                    document.getElementById('due').value = (parseFloat(document.getElementById('previous_due_amount').value) - total).toFixed(2);
                }
            </script>
            @endsection




        </div>
    </div>
@endsection
