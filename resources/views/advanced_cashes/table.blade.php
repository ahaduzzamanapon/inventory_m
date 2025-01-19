<div class="table-responsive">
    <table class="table" id="advancedCashes-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Member</th>
        <th>Purpose</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($advancedCashes as $key => $advancedCash)
            <tr>
                <td>{{ $advancedCash->id }}</td>
            <td>{{ $advancedCash->user_name }}</td>
            <td>{{ $advancedCash->purpose }}</td>
            <td>{{ $advancedCash->amount }}</td>
            <td>{{ $advancedCash->status }}</td>
            <td>{{ $advancedCash->created_at }}</td>
            <td>{{ $advancedCash->updated_at }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('advancedCashes.show', [$advancedCash->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        @if($advancedCash->status == 'Pending' || $advancedCash->status == 'Approved')
                        <a href="{{ route('advancedCashes.edit', [$advancedCash->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        @endif
                        @if($advancedCash->status == 'Pending')
                        {!! Form::open(['route' => ['advancedCashes.destroy', $advancedCash->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="im im-icon-Remove" data-toggle="tooltip" data-placement="top" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                        @endif

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
