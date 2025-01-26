<div class="table-responsive">
    <table class="table data_t" id="pettyCashes-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Date</th>
        <th>Account Ledgers</th>
        <th>Account Description</th>
        <th>Amount</th>
        <th>Attachment</th>
        <th>Status</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pettyCashes as $key => $pettyCash)
            <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{date('d-m-Y', strtotime($pettyCash->date))  }}</td>
            <td>{{ $pettyCash->account_ledger_name }}</td>
            <td>{{ $pettyCash->account_description }}</td>
            <td>{{ $pettyCash->amount }}</td>
            <td>{{ $pettyCash->attachment }}</td>
            <td>{{ $pettyCash->status }}</td>

                <td>
                    {!! Form::open(['route' => ['pettyCashes.destroy', $pettyCash->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('pettyCashes.show', [$pettyCash->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('pettyCashes.edit', [$pettyCash->id]) }}" class='btn btn-outline-primary btn-xs'><i
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
