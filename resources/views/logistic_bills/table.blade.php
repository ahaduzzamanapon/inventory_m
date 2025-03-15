<div class="table-responsive">
    <table class="table data_t" id="logisticBills-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Date</th>
        <th>Location</th>
        <th>Customer</th>
        <th>Amount</th>
        <th>Attachment</th>
        <th>Note</th>
        <th>Status</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($logisticBills as $key => $logisticBill)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ date('d-m-Y', strtotime($logisticBill->date)) }}</td>
            <td>{{ $logisticBill->location }}</td>
            <td>{{ $logisticBill->customer_name }}</td>
            <td>{{ $logisticBill->amount }}</td>
            <td>{{ $logisticBill->attachment }}</td>
            <td>{{ $logisticBill->note }}</td>
            <td>
                <span class="badge {{ $logisticBill->status == 'Pending' ? 'badge-danger' : ($logisticBill->status == 'Approved' ? 'badge-success' : 'badge-warning') }}">{{ $logisticBill->status }}</span>
            </td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('logisticBills.show', [$logisticBill->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        @if($logisticBill->status != 'Approved')
                        <a href="{{ route('logisticBills.edit', [$logisticBill->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                            @if(can('delete_option'))
                            {!! Form::open(['route' => ['logisticBills.destroy', $logisticBill->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="im im-icon-Remove" data-toggle="tooltip" data-placement="top" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                            @endif
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
