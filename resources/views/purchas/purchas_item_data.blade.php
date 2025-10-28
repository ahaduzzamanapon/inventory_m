<div class="mb-4 col-md-12">
    <h3 class="text-primary">Items Purchased</h3>
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
            @foreach($PurchasItem as $item)
            @php
                $total_qty += $item->purchas_qty;
                $total_price += $item->total_price;
            @endphp
            <tr>
                <td>
                    <input type="hidden" name="purchas_details_id[]" value="{{ $item->id }}">
                    <?= get_item_name_by_id($item['item_id']) ?>
                </td>
                <td>{{ number_format($item->item_per_price, 2) }}</td>
                <td>{{ $item->purchas_qty }}</td>
                <td>{{ number_format($item->total_price, 2) }}</td>
                <td>
                    <input type="number" name="return_qty[]" onkeyup="if(this.value > {{ $item->purchas_qty }}) this.value = {{ $item->purchas_qty }}" class="form-control" value="0" min="0" max="{{ $item->purchas_qty }}" required>
                </td>
                <td>
                    <input type="number" name="return_amount[]" class="form-control" value="0" min="0" step="0.01" required>
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
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
