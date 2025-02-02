<style>
    .data_drop {
        background-color: white;
        padding: 10px;
    }
</style>
<div class="table-responsive">
    <table class="table data_t">
        <thead>
            <tr>
                <th>Sales ID</th>
                <th>Customer</th>
                <th>Sale Date</th>
                <th>Reference No</th>
                <th>Sub Total</th>
                <th>Discount Amount</th>
                <th>Tax Amount</th>
                <th>Grand Total</th>
                <th>Payment Status</th>
                <th>Payment Amount</th>
                <th>Due Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->sales_id }}</td>
                <td>{{ get_customer_with_id($sale->customer_id)->customer_name }}</td>
                <td>{{ $sale->sale_date }}</td>
                <td>{{ $sale->reference_no }}</td>
                <td>{{ $sale->sub_total }}</td>
                <td>{{ $sale->discount_amount }}</td>
                <td>{{ $sale->tax_amount }}</td>
                <td>{{ $sale->grand_total }}</td>
                <td>
                    <span class="badge {{ $sale->payment_status == 'Pending' ? 'badge-danger' : ($sale->payment_status == 'Paid' ? 'badge-success' : 'badge-warning') }}">{{ $sale->payment_status }}</span>
                </td>
                <td>{{ $sale->payment_amount }}</td>
                <td>{{ $sale->due_amount }}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="data_drop dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item bg-info text-white" href="{{ route('sales.show', [$sale->id]) }}" style="border-radius: 10px;"><i class="im im-icon-Eye"></i> View</a>
                            {{-- <a class="dropdown-item" href="{{ route('sales.edit', [$sale->id]) }}"><i class="im im-icon-Pen"></i> Edit</a> --}}
                            @if(can('delete_option'))
                            <a href="{{url('sales/delete/'.$sale->id.'')}}" onclick="return confirm('Are you sure?')" class="dropdown-item bg-danger text-white" style="border-radius: 10px;"><i class="im im-icon-Remove"></i> Delete</a>
                            @endif
                            <a href="{{url('sales/make_payment/'.$sale->id.'')}}" class="dropdown-item bg-warning text-white" style="border-radius: 10px;"><i class="im im-icon-Add"></i> Make Payment</a>
                            <a href="{{url('sales/make_payment/'.$sale->id.'')}}" class="dropdown-item bg-info text-white" style="border-radius: 10px;"><i class="im im-icon-Eye-Invisible"></i> Payment History</a>
                            <a target="_blank" href="{{url('sales/invoice/'.$sale->id.'')}}" class="dropdown-item bg-info text-white" style="border-radius: 10px;"><i class="im im-icon-Paper"></i> Invoice</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@section('footer_scripts')
    @if (Session::has('sales_id'))
        <script>
            $(document).ready(function () {
                window.open("{{ url('sales/invoice/' . Session::get('sales_id')) }}", '_blank');
            });
        </script>
    @endif
@endsection


