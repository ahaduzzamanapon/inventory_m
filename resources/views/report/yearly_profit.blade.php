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
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .summary {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>

    <h2>Sales</h2>
    <table>
        <thead>
            <tr>
                <th>SL</th>
                @foreach($headers['sales'] as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data['sales'] as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Purchases</h2>
    <table>
        <thead>
            <tr>
                <th>SL</th>
                @foreach($headers['purchases'] as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data['purchases'] as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h3>Summary</h3>
        <p>Total Sales: {{ $data['totalSales'] }}</p>
        <p>Total Purchases: {{ $data['totalPurchases'] }}</p>
        <p>Total Profit: {{ $data['totalProfit'] }}</p>
    </div>
</body>
</html>
