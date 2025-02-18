<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Date: {{ $date }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Emp Id</th>
                            <th>Name</th>
                            <th>Present Status</th>
                            <th>Late Status</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendence as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->u_emp_id }}</td>
                                <td>{{ $user->name.' '.$user->last_name }}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->late_status }}</td>
                                <td>{{ $user->late_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

