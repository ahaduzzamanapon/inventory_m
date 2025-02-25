@include('report.report_header')
<div style="place-items: anchor-center;place-self: center;">
    <h5 class="text-primary">{{$report_title}}</h5>
</div>
<div id="report-data-view">
    <table id="report-table" class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Purchase ID</th>
                <th>Supplier</th>
                <th>Purchase Date</th>
                <th>Discount Amount</th>
                <th>Tax Amount</th>
                <th>Grand Total</th>
                <th>Payment Amount</th>
                <th>Due Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase as $purchas)
                <tr>
                    <td>{{ $purchas->purchas_id }}</td>
                    <td>{{ $purchas->supplier_name }}</td>
                    <td>{{ $purchas->purchas_date }}</td>
                    <td>{{ number_format($purchas->discount_amount, 2) }}</td>
                    <td>{{ number_format($purchas->tax_amount, 2) }}</td>
                    <td>{{ number_format($purchas->grand_total, 2) }}</td>
                    <td>{{ number_format($purchas->payment_amount, 2) }}</td>
                    <td>{{ number_format($purchas->due_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align:right;">Total:</th>
                <th>{{ number_format($purchase->sum('grand_total'), 2) }}</th>
                <th>{{ number_format($purchase->sum('payment_amount'), 2) }}</th>
                <th>{{ number_format($purchase->sum('due_amount'), 2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>

