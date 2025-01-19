<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-3">
                    {!! Form::label('customer_id', 'Customer:') !!}
                    {!! Form::select('customer_id', $customers, null, ['class' => 'form-control chosen-select', 'required']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('sale_date', 'Date:') !!}
                    {!! Form::date('sale_date', null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group col-md-3">
                    {!! Form::label('reference_no', 'Reference:') !!}
                    {!! Form::text('reference_no', 'Ref-' . time(), [
                        'class' => 'form-control',
                        'placeholder' => 'Reference Number',
                    ]) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('sales_id', 'Sales ID:') !!}
                    {!! Form::text('sales_id', 'sale-' . time(), [
                        'class' => 'form-control',
                        'placeholder' => 'Sales ID',
                        'readonly',
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-12">
                {!! Form::label('select_item_id', 'Select Item:') !!}
                {!! Form::select('select_item_id', $items, null, [
                    'class' => 'form-control chosen-select',
                    'onchange' => 'selectItem(this.value)',
                ]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-light table-hover table-bordered table-striped col-md-12">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="items_table_body">
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-light table-hover table-bordered table-striped">
                                <tr>
                                    <th>Tax:</th>
                                    <th>
                                        <select name="tax_type" id="tax_type" onchange="calculate_dis_tax()">
                                            <option value="Fixed">Fixed</option>
                                            <option value="Percentage">Percentage</option>
                                        </select>
                                    </th>
                                    <th>
                                        <input type="text" onkeyup="calculate_dis_tax()" name="tax_per" id="tax_per"
                                            class="form-control text-right"value="0">
                                    </th>
                                </tr>
                                <tr>
                                    <th>Discount:</th>
                                    <th>
                                        <select name="discount_type" id="discount_type" onchange="calculate_dis_tax()">
                                            <option value="Fixed">Fixed</option>
                                            <option value="Percentage">Percentage</option>
                                        </select>
                                    </th>
                                    <th>
                                        <input type="text" name="discount_per" id="discount_per"
                                            onkeyup="calculate_dis_tax()" class="form-control text-right" value="0">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3">
                                        <div class="form-group">
                                            <label for="" class="control-label">Note</label>
                                            <textarea name="sale_note" class="form-control"></textarea>
                                        </div>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6" style="margin-right: -22px;">
                            <div class="form-group col-md-12">
                                <table>
                                    <tr>
                                        <th>Sub Total:</th>
                                        <td><input type="text" name="sub_total_input" id="sub_total_input"
                                                class="form-control text-right" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <th>Tax:</th>
                                        <td><input type="text" name="tax_input" id="tax_input"
                                                class="form-control text-right" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <th>Discount:</th>
                                        <td><input type="text" name="discount_input" id="discount_input"
                                                class="form-control text-right" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total:</th>
                                        <td><input type="text" name="grand_total_input" id="grand_total_input"
                                                class="form-control text-right" readonly value="0"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <h1 class="col-md-12">Payment Details</h1>
                        <div class="col-md-12 table-responsive">
                            <table class="table table-light table-hover table-bordered table-striped col-md-12">
                                <thead>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Payment Method</th>
                                        <th>Payment Date</th>
                                        <th>Amount</th>
                                        <th>Action <a class="btn btn-primary" onclick="addPaymentRow()"><i
                                                    class="fa fa-plus"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody id="payment_table_body"></tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered col-md-6">
                                <tbody>
                                    <tr>
                                        <th>Total Payment:</th>
                                        <td><input type="text" name="total_payment" id="total_payment" class="form-control text-right" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <th>Due:</th>
                                        <td><input type="text" name="due" id="due" class="form-control text-right" readonly value="0"></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
                if (total > parseFloat(document.getElementById('grand_total_input').value)) {
                    $('.payment_amount').each(function() {
                        $(this).val(0);
                    });
                    total = 0;
                    alert('Payment amount cannot be greater than grand total');
                }
                document.getElementById('total_payment').value = total.toFixed(2);
                document.getElementById('due').value = (parseFloat(document.getElementById('grand_total_input').value) - total).toFixed(2);
            }
        </script>


        <script>

            function quantityChange(input) {
                var quantity =  parseFloat(input.closest('tr').querySelector('td:nth-child(2) input').value);
                var price = parseFloat(input.closest('tr').querySelector('td:nth-child(3) input').value);
                var total = quantity * price;
                input.closest('tr').querySelector('td:nth-child(4) input').value = total.toFixed(2);
                calculate_sub_total();
            }
            function calculate_sub_total() {
                var subTotal = 0;
                $('.total_input_price').each(function() {
                    subTotal += parseFloat($(this).val());
                });
                document.getElementById('sub_total_input').value = subTotal.toFixed(2);
                calculate_dis_tax()

            }

            function calculate_dis_tax() {
                calculate_tax()
                calculate_discount()
                calculate_grand_total()
            }

            function calculate_tax() {
                var subTotal = parseFloat(document.getElementById('sub_total_input').value);
                var taxType = document.getElementById('tax_type').value;
                var taxPer = parseFloat(document.getElementById('tax_per').value);
                if (taxType == 'Fixed') {
                    var tax = taxPer;
                } else {
                    var tax = subTotal * (taxPer / 100);
                }
                document.getElementById('tax_input').value = tax.toFixed(2);
            }

            function calculate_discount() {
                var subTotal = parseFloat(document.getElementById('sub_total_input').value);
                var discountType = document.getElementById('discount_type').value;
                var discountPer = parseFloat(document.getElementById('discount_per').value);
                if (discountType == 'Fixed') {
                    var discount = discountPer;
                } else {
                    var discount = subTotal * (discountPer / 100);
                }
                document.getElementById('discount_input').value = discount.toFixed(2);
            }

            function calculate_grand_total() {
                var subTotal = parseFloat(document.getElementById('sub_total_input').value);
                var tax = parseFloat(document.getElementById('tax_input').value);
                var discount = parseFloat(document.getElementById('discount_input').value);
                var grandTotal = subTotal + tax - discount;
                document.getElementById('grand_total_input').value = grandTotal.toFixed(2);
                calculatePaymentTotal()
            }
        </script>









        <script>
            function deleteRow(button) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
        </script>




        <script>
            var items = @json($items);

            // If $items is an object, convert it to an array
            if (!Array.isArray(items)) {
                items = Object.keys(items).map(key => ({
                    id: key,
                    item_name: items[key]
                }));
            }

            function selectItem(id) {
                if (!id || id == '' || id == 'select') {
                    return;
                }
                var item = items.find(item => item.id == id);
                if (!item) {
                    console.error('Item not found');
                    return;
                }

                var insertedItemIds = $('.item_id_hidden').map(function() {
                    return $(this).val();
                }).get();

                if (insertedItemIds.includes(item.id)) {
                    alert('Item already inserted');
                    return;
                }

                var tableBody = document.getElementById('items_table_body');
                var row = document.createElement('tr');
                var cell1 = document.createElement('td');
                var cell2 = document.createElement('td');
                var cell3 = document.createElement('td');
                var cell4 = document.createElement('td');
                var cell5 = document.createElement('td');
                var item_name_data = item.item_name.split('-');
                item_id_u = item_name_data[0];
                item_name_u = item_name_data[1];
                item_price = parseFloat(item_name_data[2]);


                cell1.innerHTML = item_id_u + ' - ' + item_name_u +
                    '<input type="hidden" class="item_id_hidden"  name="item_id[]" value="' + item.id + '">'+
                    '<input type="hidden" class="item_name_hidden"  name="item_name[]" value="' + item_id_u + ' - ' + item_name_u + '">';
                cell2.innerHTML =
                    '<input type="number" name="quantity[]" required min="1" onkeyup="quantityChange(this)" value="1" class="form-control">';
                cell3.innerHTML = '<input type="text" name="price[]" min="0" onkeyup="quantityChange(this)" value="' + item_price +
                    '" class="form-control text-right" >';
                cell4.innerHTML = '<input type="text" name="total_price[]" value="' + item_price +
                    '" class="form-control text-right total_input_price" readonly>';
                cell5.innerHTML =
                    '<button type="button" class="btn btn-danger btn-xs" onclick="deleteRow(this)"><i class="im im-icon-Remove"></i></button>';

                row.appendChild(cell1);
                row.appendChild(cell2);
                row.appendChild(cell3);
                row.appendChild(cell4);
                row.appendChild(cell5);
                tableBody.appendChild(row);
                $('#select_item_id').val('select').trigger('chosen:updated');
                calculate_sub_total();
            }
        </script>
    @endsection
