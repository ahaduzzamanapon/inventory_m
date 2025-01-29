<div class="table-responsive">
    <table class="table" id="bonuses-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>User Id</th>
        <th>Month</th>
        <th>Amount</th>
        <th>Reason</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bonuses as $key => $bonus)
            <tr>
                <td>{{ $bonus->id }}</td>
            <td>{{ $bonus->user_id }}</td>
            <td>{{ $bonus->month }}</td>
            <td>{{ $bonus->amount }}</td>
            <td>{{ $bonus->reason }}</td>
            <td>{{ $bonus->created_at }}</td>
            <td>{{ $bonus->updated_at }}</td>
                <td>
                    {!! Form::open(['route' => ['bonuses.destroy', $bonus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('bonuses.show', [$bonus->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('bonuses.edit', [$bonus->id]) }}" class='btn btn-outline-primary btn-xs'><i
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
