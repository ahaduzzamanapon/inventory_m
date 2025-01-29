<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;

        }
        .container {

        }
        .table th {
            background-color: #007bff;
            color: #fff;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Salary Report</h1>
    <a class="btn btn-primary mb-3" href="javascript:window.print()">Print</a>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Month</th>
            <th>Basic Salary</th>
            <th>Total Present</th>
            <th>Total Absent</th>
            <th>Absent Deduction</th>
            <th>Bonus Amount</th>
            <th>Total Salary</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($salaries as $salary)
            <tr>
                <td>{{ $salary->emp_id }}</td>
                <td>{{ $salary->name }} {{ $salary->last_name }}</td>
                <td>{{ \Carbon\Carbon::parse($salary->month)->format('F Y') }}</td>
                <td>{{ number_format($salary->salary, 2) }}</td>
                <td>{{ $salary->total_present }}</td>
                <td>{{ $salary->total_absent }}</td>
                <td>{{ number_format($salary->absent_deduct, 2) }}</td>
                <td>{{ number_format($salary->bonus_amount, 2) }}</td>
                <td>{{ number_format($salary->gross_salary, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
