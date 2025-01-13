<div class="table-responsive">
    <table class="table data_t" id="accountLedgers-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Name</th>
        <th>Type</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountLedgers as $key => $accountLedger)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ $accountLedger->name }}</td>
            <td>{{ $accountLedger->type }}</td>
            <td>{{ $accountLedger->created_at }}</td>
            <td>{{ $accountLedger->updated_at }}</td>
                <td>
                    {!! Form::open(['route' => ['accountLedgers.destroy', $accountLedger->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accountLedgers.show', [$accountLedger->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('accountLedgers.edit', [$accountLedger->id]) }}" class='btn btn-outline-primary btn-xs'><i
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
