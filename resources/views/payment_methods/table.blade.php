<div class="table-responsive">
    <table class="table data_t" id="paymentMethods-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Method Name</th>
        <th>Method Type</th>
        <th>Method Number</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($paymentMethods as $key => $paymentMethod)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ $paymentMethod->method_name }}</td>
            <td>{{ $paymentMethod->method_type }}</td>
            <td>{{ $paymentMethod->method_number }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('paymentMethods.show', [$paymentMethod->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('paymentMethods.edit', [$paymentMethod->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        @if(can('delete_option'))
                            {!! Form::open(['route' => ['paymentMethods.destroy', $paymentMethod->id], 'method' => 'delete']) !!}
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
