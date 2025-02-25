@include('report.report_header')
<div style="place-items: anchor-center;place-self: center;">
    <h5 class="text-primary">{{$report_title}}</h5>
</div>
<div id="report-data-view">
    <table id="report-table" class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Sales ID</th>
                <th>Customer</th>
                <th>Sale Date</th>
                <th>Discount Amount</th>
                <th>Tax Amount</th>
                <th>Grand Total</th>
                <th>Payment Amount</th>
                <th>Due Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->sales_id }}</td>
                    <td>{{ $sale->customer_name }}</td>
                    <td>{{ $sale->sale_date }}</td>
                    <td>{{ number_format($sale->discount_amount, 2) }}</td>
                    <td>{{ number_format($sale->tax_amount, 2) }}</td>
                    <td>{{ number_format($sale->grand_total, 2) }}</td>
                    <td>{{ number_format($sale->payment_amount, 2) }}</td>
                    <td>{{ number_format($sale->due_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align:right;">Total:</th>
                <th>{{ number_format($sales->sum('grand_total'), 2) }}</th>
                <th>{{ number_format($sales->sum('payment_amount'), 2) }}</th>
                <th>{{ number_format($sales->sum('due_amount'), 2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>


