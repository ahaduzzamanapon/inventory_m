@include('report.report_header')
<div style="place-items: anchor-center;place-self: center;">
    <h5 class="text-primary">{{$report_title}}</h5>
</div>
<div id="report-data-view">
    <table id="report-table" class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Purpose</th>
                <th>Employee</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comissions as $comission)
                <tr>
                    <td>{{ $comission->date }}</td>
                    <td>{{ $comission->purpose }}</td>
                    <td>{{ $comission->employee_name }}</td>
                    <td>{{ $comission->customer_name }}</td>
                    <td>{{ number_format($comission->amount, 2) }}</td>
                    <td>{{ $comission->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
