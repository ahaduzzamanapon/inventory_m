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
                <tr>
                    <td>{{ $key + 1 }}</td>
                    @php
                        $col_index = 0;
                    @endphp
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                        @php
                            if (is_numeric($cell)) {
                                $totals[$col_index] += $cell;
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
                @foreach($totals as $total)
                    <td><strong>{{ $total > 0 ? $total : '' }}</strong></td>
                @endforeach
            </tr>
        </tfoot>
    </table>
</body>
</html>
