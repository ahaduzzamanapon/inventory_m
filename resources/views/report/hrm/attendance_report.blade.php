<div class="table-responsive">
    <h3 class="text-center">{{$report_title}}</h3>
    @foreach ($data as $userName => $attendances)
        <h4>User: {{ $userName }}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Late Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $item)
                    <tr>
                        <td>{{$item->date}}</td>
                        <td>{{$item->late_time}}</td>
                        <td>{{$item->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    @endforeach
</div>
