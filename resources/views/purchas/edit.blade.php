@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Purchas Edit @parent
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        {{--<div aria-label="breadcrumb" class="card-breadcrumb mb-4">
            <h1 class="text-primary">Purchas Details</h1>
        </div>
        <div class="separator-breadcrumb border-top"></div>--}}
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
            {!! Form::model($purchas, ['route' => ['purchas.update', $purchas->id], 'method' => 'patch','class' => 'form-horizontal col-md-12']) !!}
            <h3>Items Purchased</h3>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($PurchasItem as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <input type="hidden" name="item_id[]"  value="<?= $item['item_id'] ?>">
                                <input type="hidden" name="purchas_qty[]" class="purchas_qty" value="<?= $item['purchas_qty'] ?>">
                                <?= get_item_name_by_id($item['item_id']) ?>
                            </td>
                            <td class="text-right">
                                <input type="text" class="form-control text-right" name="item_per_price[]" onkeyup="calculate_total_price(this)" id="item_per_price" value="<?= $item['item_per_price'] ?>">
                            </td>
                            <td class="text-right"><?= $item['purchas_qty'] ?></td>
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
                            <input type="text" class="form-control text-right" name="sub_total" id="sub_total" value="<?= number_format($purchas['sub_total'], 2) ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Discount</td>
                        <td class="text-right">
                            <input type="text" class="form-control text-right" name="discount_amount" id="discount_amount" value="<?= number_format($purchas['discount_amount'], 2) ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Tax</td>
                        <td class="text-right">
                            <input type="text" class="form-control text-right" name="tax_amount" id="tax_amount" value="<?= number_format($purchas['tax_amount'], 2) ?>" readonly>
                        </td>
                    </tr>
                    <tr class="">
                        <td colspan="4" class="text-right">Grand Total</td>
                        <td class="text-right">
                            <input type="text" class="form-control text-right" name="grand_total" id="grand_total" value="<?= number_format($purchas['grand_total'], 2) ?>" readonly>
                        </td>
                    </tr>
                </tfoot>
            </table>
    


          
            <div class="form-group col-sm-12" style="text-align-last: right;">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('subCategories.index') }}" class="btn btn-danger">Cancel</a>
            </div>
            {!! Form::close() !!}
            @section('footer_scripts')
            <script>
                function calculate_total_price(input) {
                    var row = $(input).closest('tr');
                    var unit_price = parseFloat(row.find('input[name="item_per_price[]"]').val());
                    var quantity = parseFloat(row.find('input[name="purchas_qty[]"]').val());
                    var total_price = unit_price * quantity;
                    row.find('input[name="total_price[]"]').val(total_price.toFixed(2));
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
            
            @endsection




        </div>
    </div>
@endsection
