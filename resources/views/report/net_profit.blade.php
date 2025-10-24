<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: sans-serif;
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

    <div class="summary">
        <h3>Summary</h3>
        <p>Total Sales: {{ $data['totalSales'] }}</p>
        <p>Total Expenses: {{ $data['totalExpenses'] }}</p>
        <p>Net Profit: {{ $data['netProfit'] }}</p>
    </div>
</body>
</html>
