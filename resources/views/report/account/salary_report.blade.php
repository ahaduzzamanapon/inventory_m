@include('report.report_header')
<div style="place-items: anchor-center;place-self: center;">
    <h5 class="text-primary">{{$report_title}}</h5>
</div>
<div id="report-data-view">
    <table id="report-table" class="table table-hover table-striped">
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
                    <td>{{ $salary->user_name }}</td>
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
