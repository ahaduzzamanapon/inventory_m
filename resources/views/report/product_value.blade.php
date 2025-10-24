<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>SL</th>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                $totals = array_fill(0, count($headers), 0);
            @endphp
            @foreach($data as $key => $row)
                @php
                    $totalValue = $row->item_qty * $row->item_purchase_price;
                @endphp
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row->item_name }}</td>
                    <td>{{ $row->item_qty }}</td>
                    <td>{{ $row->item_purchase_price }}</td>
                    <td>{{ $totalValue }}</td>
                    @php
                        $totals[1] += $row->item_qty;
                        $totals[2] += $row->item_purchase_price;
                        $totals[3] += $totalValue;
                    @endphp
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td><strong>Total:</strong></td>
                <td><strong>{{ $totals[1] }}</strong></td>
                <td><strong>{{ $totals[2] }}</strong></td>
                <td><strong>{{ $totals[3] }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
