<div class="table-responsive">
    <table class="table" id="attendences-table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Date</th>
                <th>Total</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
                <th>On Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($attendences as $key => $attendence)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $attendence->date }}</td>
                <td>{{ $attendence->total }}</td>
                <td>{{ $attendence->present }}</td>
                <td>{{ $attendence->absent }}</td>
                <td>{{ $attendence->late }}</td>
                <td>{{ $attendence->on_time }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('attendences.show', [$attendence->date]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('attendences.edit', [$attendence->date]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Pen" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

