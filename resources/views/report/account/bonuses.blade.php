<h3>{{ $report_title }}</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>User Name</th>
            <th>Bonus</th>
            <th>Month</th>
            <th>Year</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->date }}</td>
                <td>{{ $item->user_name }}</td>
                <td>{{ $item->bonus }}</td>
                <td>{{ $item->month }}</td>
                <td>{{ $item->year }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
