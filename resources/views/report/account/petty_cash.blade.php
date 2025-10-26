<h3>{{ $report_title }}</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Ledger Name</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->date }}</td>
                <td>{{ $item->ledger_name }}</td>
                <td>{{ $item->amount }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
