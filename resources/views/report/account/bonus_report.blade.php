@include('report.report_header')
<div style="place-items: anchor-center;place-self: center;">
    <h5 class="text-primary">{{$report_title}}</h5>
</div>
<div id="report-data-view">
    <table id="report-table" class="table table-hover table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Month</th>
                <th>Amount</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bonuses as $bonus)
                <tr>
                    <td>{{ $bonus->user_name }}</td>
                    <td>{{ $bonus->month }}</td>
                    <td>{{ number_format($bonus->amount, 2) }}</td>
                    <td>{{ $bonus->reason }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
