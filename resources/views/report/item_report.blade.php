@extends('layouts.default')

@section('title', 'Item Report')

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">
@stop

@section('content')
<section class="content-header">
    <h1>Item Report for {{ $item->item_name }}</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $item->item_name }}</h5>
            <div class="card-tools">
                <button class="btn btn-primary" id="download-pdf">Download PDF</button>
            </div>
        </div>
        <div class="card-body">
            <h3>Sales</h3>
            <table class="table table-bordered" id="sales-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->sale_date }}</td>
                            <td>{{ $sale->customer_name }}</td>
                            <td>{{ $sale->sales_qty }}</td>
                            <td>{{ $sale->item_per_price }}</td>
                            <td>{{ $sale->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="text-align:right;">Total:</th>
                        <th>{{ $sales->sum('sales_qty') }}</th>
                        <th>{{ $sales->sum('item_per_price') }}</th>
                        <th>{{ $sales->sum('total_price') }}</th>
                    </tr>
                </tfoot>
            </table>

            <h3 class="mt-4">Purchases</h3>
            <table class="table table-bordered" id="purchases-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->purchas_date }}</td>
                            <td>{{ $purchase->supplier_name }}</td>
                            <td>{{ $purchase->purchas_qty }}</td>
                            <td>{{ $purchase->item_per_price }}</td>
                            <td>{{ $purchase->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
                 <tfoot>
                    <tr>
                        <th colspan="2" style="text-align:right;">Total:</th>
                        <th>{{ $purchases->sum('purchas_qty') }}</th>
                        <th>{{ $purchases->sum('item_per_price') }}</th>
                        <th>{{ $purchases->sum('total_price') }}</th>
                    </tr>
                </tfoot>
            </table>

            <div class="summary mt-4">
                <h3>Summary</h3>
                <p><strong>Total Sales:</strong> {{ $sales->sum('total_price') }}</p>
                <p><strong>Total Purchases:</strong> {{ $purchases->sum('total_price') }}</p>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer_scripts')
<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        const salesTable = document.getElementById('sales-table');
        const purchasesTable = document.getElementById('purchases-table');

        function getTableData(table) {
            const header = [];
            const body = [];
            const footer = [];

            // Get header
            for (let i = 0; i < table.tHead.rows[0].cells.length; i++) {
                header.push({ text: table.tHead.rows[0].cells[i].innerText, bold: true });
            }
            body.push(header);

            // Get body
            for (let i = 0; i < table.tBodies[0].rows.length; i++) {
                const row = [];
                for (let j = 0; j < table.tBodies[0].rows[i].cells.length; j++) {
                    row.push(table.tBodies[0].rows[i].cells[j].innerText);
                }
                body.push(row);
            }

            // Get footer
            const footerRow = table.tFoot.rows[0];
            const footerData = [
                { text: footerRow.cells[0].innerText, colSpan: 2, alignment: 'right', bold: true },
                {},
                { text: footerRow.cells[1].innerText, bold: true },
                { text: footerRow.cells[2].innerText, bold: true },
                { text: footerRow.cells[3].innerText, bold: true }
            ];
            body.push(footerData);

            return body;
        }

        const salesData = getTableData(salesTable);
        const purchasesData = getTableData(purchasesTable);

        const docDefinition = {
            content: [
                { text: 'Item Report for {{ $item->item_name }}', style: 'header' },
                { text: 'Sales', style: 'subheader' },
                {
                    table: {
                        headerRows: 1,
                        body: salesData,
                        widths: ['*', '*', '*', '*', '*']
                    }
                },
                { text: 'Purchases', style: 'subheader', margin: [0, 20, 0, 0] },
                {
                    table: {
                        headerRows: 1,
                        body: purchasesData,
                        widths: ['*', '*', '*', '*', '*']
                    }
                },
                { text: 'Summary', style: 'subheader', margin: [0, 20, 0, 0] },
                { text: 'Total Sales: {{ $sales->sum('total_price') }}' },
                { text: 'Total Purchases: {{ $purchases->sum('total_price') }}' }
            ],
            styles: {
                header: {
                    fontSize: 18,
                    bold: true,
                    margin: [0, 0, 0, 10]
                },
                subheader: {
                    fontSize: 14,
                    bold: true,
                    margin: [0, 10, 0, 5]
                }
            }
        };

        pdfMake.createPdf(docDefinition).download('item_report.pdf');
    });
</script>
@stop
