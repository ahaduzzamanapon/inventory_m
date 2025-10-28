@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Sales Edit @parent
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
                                {!! Form::model($sales, ['route' => ['sales.update', $sales->id], 'method' => 'patch','class' => 'form-horizontal col-md-12', 'id' => 'sales-edit-form']) !!}

                    @if(can('update_sales_customer'))
                    <div class="form-group">
                        <label for="customer_id">Change Customer</label>
                        {!! Form::select('customer_id', $customers, $sales->customer_id, ['class' => 'form-control'])
 !!}
                    </div>
                    @else
                    <input type="hidden" name="customer_id" value="{{ $sales->customer_id }}">
                    @endif
                </div>
            </div>
            <h3>Items Sold</h3>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($SalesItem as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <input type="hidden" name="item_id[]" value="<?= $item['item_id'] ?>">
                            <input type="hidden" name="sale_id[]" value="<?= $item['sale_id'] ?>">
                            <input type="hidden" name="sales_qty[]" id="sales_qty" value="<?= $item['sales_qty'] ?>">
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
                        <td class="text-right">
                            <input type="text" class="form-control text-right" name="item_per_price[]" onkeyup="calculate_total_price(this)" id="item_per_price" value="<?= $item['item_per_price'] ?>">
                        </td>
                        <td class="text-right">
                            <?= $item['sales_qty'] ?>
                        </td>
                        <td class="text-right">
                            <input type="text" class="form-control text-right total_price" name="total_price[]" id="total_price" value="<?= $item['total_price'] ?>" readonly>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right">Sub Total</td>
                    <td class="text-right">
                        <input type="text" class="form-control text-right" name="sub_total" id="sub_total" value="{{ $sales['sub_total'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Discount</td>
                    <td class="text-right">
                        <input type="text" class="form-control text-right" name="discount_amount" id="discount_amount" value="{{ $sales['discount_amount'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Tax</td>
                    <td class="text-right">
                        <input type="text" class="form-control text-right" name="tax_amount" id="tax_amount" value="{{ $sales['tax_amount'] }}" readonly>
                    </td>
                </tr>
                <tr class="">
                    <td colspan="4" class="text-right">Grand Total</td>
                    <td class="text-right">
                        <input type="text" class="form-control text-right" name="grand_total" id="grand_total" value="{{ $sales['grand_total'] }}" readonly>
                    </td>
                </tr>
            </tfoot>
        </table>


           
            <div class="form-group col-sm-12" style="text-align-last: right;">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
            @section('footer_scripts')
            <script>
                function calculate_total_price(input) {
                    var sales_qty = $(input).closest('tr').find('#sales_qty').val();
                    var item_per_price = $(input).val();
                    var total_price = sales_qty * item_per_price;
                    $(input).closest('tr').find('#total_price').val(total_price);
                    calculate_sub_total();
                }
            </script>
            <script>
                function calculate_sub_total() {
                    var subTotal = 0;
                    $('.total_price').each(function() {
                        subTotal += parseFloat($(this).val());
                    });
                    document.getElementById('sub_total').value = subTotal.toFixed(2);
                    calculate_grand_total();
                }
            </script>
            <script>
                function calculate_grand_total() {
                    var sub_total = parseFloat(document.getElementById('sub_total').value);
                    var discount_amount = parseFloat(document.getElementById('discount_amount').value);
                    var tax_amount = parseFloat(document.getElementById('tax_amount').value);
                    var grand_total = sub_total - discount_amount + tax_amount;
                    document.getElementById('grand_total').value = grand_total.toFixed(2);
                }
            </script>
            {{-- <script>
                $(document).ready(function() {
                    $('#sales-edit-form').on('submit', function(e) {
                        e.preventDefault();
                        var form = $(this);
                        var url = form.attr('action');
                        var data = form.serialize();
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: data,
                            success: function(response) {
                                window.location.href = "{{ route('sales.sales_list') }}";
                            },
                            error: function(xhr, status, error) {
                                var errors = xhr.responseJSON.errors;
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        var error_message = errors[key][0];
                                        alert(error_message);
                                    }
                                }
                            }
                        });
                    });
                });
            </script>
            --}}
            @endsection




        </div>
    </div>
@endsection