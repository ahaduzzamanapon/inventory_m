<div class="table-responsive">
    <table class="table" id="logisticBills-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Date</th>
        <th>Sale</th>
        <th>Location</th>
        <th>Customer</th>
        <th>Amount</th>
        <th>Attachment</th>
        <th>Note</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($logisticBills as $key => $logisticBill)
            <tr>
                <td>{{ $logisticBill->id }}</td>
            <td>{{ $logisticBill->date }}</td>
            <td>{{ $logisticBill->Sale }}</td>
            <td>{{ $logisticBill->location }}</td>
            <td>{{ $logisticBill->customer }}</td>
            <td>{{ $logisticBill->amount }}</td>
            <td>{{ $logisticBill->attachment }}</td>
            <td>{{ $logisticBill->note }}</td>
            <td>{{ $logisticBill->status }}</td>
            <td>{{ $logisticBill->created_at }}</td>
            <td>{{ $logisticBill->updated_at }}</td>
                <td>
                    {!! Form::open(['route' => ['logisticBills.destroy', $logisticBill->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logisticBills.show', [$logisticBill->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('logisticBills.edit', [$logisticBill->id]) }}" class='btn btn-outline-primary btn-xs'><i
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
