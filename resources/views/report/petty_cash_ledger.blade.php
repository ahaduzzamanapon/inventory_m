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

    <h2>Credit</h2>
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
                $credit_totals = array_fill(0, count($headers), 0);
            @endphp
            @foreach($data['credit'] as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    @php
                        $col_index = 0;
                    @endphp
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                        @php
                            if (is_numeric($cell)) {
                                $credit_totals[$col_index] += $cell;
                            }
                            $col_index++;
                        @endphp
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                @foreach($credit_totals as $total)
                    <td><strong>{{ $total > 0 ? $total : '' }}</strong></td>
                @endforeach
            </tr>
        </tfoot>
    </table>

    <h2>Debit</h2>
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
                $debit_totals = array_fill(0, count($headers), 0);
            @endphp
            @foreach($data['debit'] as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    @php
                        $col_index = 0;
                    @endphp
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                        @php
                            if (is_numeric($cell)) {
                                $debit_totals[$col_index] += $cell;
                            }
                            $col_index++;
                        @endphp
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                @foreach($debit_totals as $total)
                    <td><strong>{{ $total > 0 ? $total : '' }}</strong></td>
                @endforeach
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <h3>Summary</h3>
        <p>Total Credit: {{ $data['totalCredit'] }}</p>
        <p>Total Debit: {{ $data['totalDebit'] }}</p>
        <p>Running Petty Cash: {{ $data['runningPettyCash'] }}</p>
    </div>
</body>
</html>
