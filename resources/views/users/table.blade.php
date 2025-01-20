




<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Emp Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Group</th>
                <th>Email</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $users)
            <tr>
                <td>{{ $key+1 }}</td>
            <td>{{ $users->emp_id }}</td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->last_name }}</td>
            <td>{{ $users->role }}</td>
            <td>{{ $users->email }}</td>
            <td>{{ $users->salary }}</td>
                <td>
                    {!! Form::open(['route' => ['users.destroy', $users->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('users.show', [$users->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('users.edit', [$users->id]) }}" class='btn btn-outline-primary btn-xs'><i
                                class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        {!! Form::button('<i class="im im-icon-Remove" data-toggle="tooltip" data-placement="top" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
