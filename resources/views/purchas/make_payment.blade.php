@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Make Payment @parent
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
                        <li class="list-group-item"><strong>Payment Status:</strong> <span
                                class="badge badge-{{ $purchas->payment_status == 'Paid' ? 'success' : 'warning' }}">{{ $purchas->payment_status }}</span>
                        </li>
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


            <!-- Payment Details -->
            <div class="mb-4">
                <h5 class="text-primary">Previous Payment Details</h5>
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
                        @foreach ($PurchasPayment as $payment)
                            <tr>
                                <td>{{ $payment->payment_id }}</td>
                                <td>{{ $payment->payment_date }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ number_format($payment->payment_amount, 2) }}</td>
                                <td><span
                                        class="badge badge-{{ $payment->payment_status == 'Paid' ? 'success' : 'warning' }}">{{ $payment->payment_status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Paid Amount:</strong>
                        {{ number_format($purchas->payment_amount, 2) }}</li>
                    <li class="list-group-item"><strong>Due Amount:</strong> {{ number_format($purchas->due_amount, 2) }}
                    </li>
                </ul>
            </div>
            {!! Form::open(['route' => ['purchas.payment.store'], 'method' => 'POST']) !!}
            <input type="hidden" name="purchas_id" value="{{ $purchas->id }}">
            <input type="hidden" name="previous_due_amount" id="previous_due_amount" value="{{ $purchas->due_amount }}">
            <div class="col-md-12">
                <h1>Make Payment</h1>
                <table class="table table-light table-hover table-bordered table-striped col-md-12">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
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

                function addPaymentRow() {
                    console.log(paymentMethods);

                    var paymentMethodOptions = paymentMethods.map(function(paymentMethod) {
                        return '<option value="' + paymentMethod.id + '">' + paymentMethod.method_name + '</option>';
                    }).join('');

                    var paymentTableBody = document.getElementById('payment_table_body');
                    var uniq_id = 'pay-' + Math.random().toString(10).substr(2, 9);
                    var newRow = document.createElement('tr');
                    newRow.innerHTML = '<td><input type="text" name="payment_id[]" value="' + uniq_id +
                        '" class="form-control"></td>' +
                        '<td><select name="payment_method_id[]" required class="form-control">' + paymentMethodOptions + '</select></td>' +
                        '<td><input type="date" name="payment_date[]" class="form-control" required></td>' +
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
