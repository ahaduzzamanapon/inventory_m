 <!-- Sales Items -->
 <div class="mb-4 col-md-12">
    <h3 class="text-primary">Items Sold</h3>
    <table class="table table-hover table-striped">
        <thead class="table-primary">
            <tr>
                <th>Item Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Return</th>
                <th>Total Return Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_qty = 0;
                $total_price = 0;
            @endphp
            @foreach($SalesItem as $item)
            @php
                $total_qty += $item->sales_qty;
                $total_price += $item->total_price;
            @endphp
            <tr>
                <td>
                    <input type="hidden" name="sales_details_id[]" value="{{ $item->id }}">
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
                <td>
                    <input type="number" name="return_qty[]" {{($item['item_serial'] !== null)?'readonly':''}} onchange="calculate_return_amount(this)" onkeyup="if(this.value > {{ $item->sales_qty }}) this.value = {{ $item->sales_qty }}" class="form-control" value="0" min="0" max="{{ $item->sales_qty }}" required>
                    <div class="serial_div">
                        @if ($item['item_serial'] !== null)
                            @php
                                $itemSerials = DB::table('item_serials')->whereIn('id', json_decode($item['item_serial']))->get();
                            @endphp
                            @foreach ($itemSerials as $serial)
                                <div class="form-check">
                                    <input class="form-check-input" onchange="checkItemSerial(event, this), calculate_total_return_amount(this)" type="checkbox" name="return_serial[{{ $item->id }}][]" value="{{ $serial->id }}">
                                    <label class="form-check-label">{{ $serial->item_serial_number }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </td>
                <td>
                    <input type="number" name="return_amount[]" onkeyup="checkItemSerial(event, this),calculate_total_return_amount(this)" class="form-control" value="0" min="0" step="0.01" required>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Total</td>
                <td>{{ $total_qty }}</td>
                <td>{{ number_format($total_price, 2) }}</td>
                <td></td>
                <td ><input id="total_return_amount" type="text" name="total_return_amount" class="form-control text-right" readonly value="0"></td>
            </tr>
        </tfoot>
    </table>
</div>


<script>
    function checkItemSerial(event, el) {
        let serialDiv = el.closest('.serial_div');
        if (serialDiv) {
            let serialCheckboxes = serialDiv.querySelectorAll('input[type="checkbox"]');
            let checkedSerials = [];
            serialCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedSerials.push(checkbox.value);
                }
            });
            console.log(checkedSerials);
            let serialInput = serialDiv.closest('td').querySelector('input[type="number"]');
            if (serialInput) {
                serialInput.value = checkedSerials.length;
            }
            calculate_return_amount(el);
        }
    }
   function calculate_return_amount(el){
    let returnQty = parseFloat(el.value) || 0;
    let itemRow = el.closest('tr');

    // Get unit price text & convert to number
    let unitPriceText = itemRow.querySelector('td:nth-child(2)').innerText;
    let unitPrice = parseFloat(unitPriceText.replace(/,/g, '')) || 0;

    let returnAmountInput = itemRow.querySelector('input[name="return_amount[]"]');

    let total = returnQty * unitPrice;
    returnAmountInput.value = total.toFixed(2);

    calculate_total_return_amount();
}

function calculate_total_return_amount(){
    let returnAmountInputs = document.querySelectorAll('input[name="return_amount[]"]');
    let totalReturnAmount = 0;

    returnAmountInputs.forEach(input => {
        totalReturnAmount += parseFloat(input.value) || 0;
    });

    document.getElementById('total_return_amount').value = totalReturnAmount.toFixed(2);
}

</script>


