<h3>{{ $report_title }}</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>User Name</th>
            <th>Sale</th>
            <th>Location</th>
            <th>Amount</th>
            <th>Note</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->date }}</td>
                <td>{{ $item->user_name }}</td>
                <td>{{ $item->Sale }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->amount }}</td>
                <td>{{ $item->note }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
