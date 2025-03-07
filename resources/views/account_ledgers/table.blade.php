<div class="table-responsive">
    <table class="table data_t" id="accountLedgers-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Name</th>
        <th>Type</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountLedgers as $key => $accountLedger)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ $accountLedger->name }}</td>
            <td>{{ $accountLedger->type }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('accountLedgers.show', [$accountLedger->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('accountLedgers.edit', [$accountLedger->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        @if(can('delete_option'))
                        {!! Form::open(['route' => ['accountLedgers.destroy', $accountLedger->id], 'method' => 'delete']) !!}
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
