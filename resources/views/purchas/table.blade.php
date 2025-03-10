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
                <th>Purchas ID</th>
                <th>Supplier</th>
                <th>Purchas Date</th>
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
            @foreach ($purchas as $purchas)
            <tr>
                <td>{{ $purchas->purchas_id }}</td>
                <td>{{ get_supplier_with_id($purchas->supplier_id)->supplier_name }}</td>
                <td>{{ $purchas->purchas_date }}</td>
                <td>{{ $purchas->reference_no }}</td>
                <td>{{ $purchas->sub_total }}</td>
                <td>{{ $purchas->discount_amount }}</td>
                <td>{{ $purchas->tax_amount }}</td>
                <td>{{ $purchas->grand_total }}</td>
                <td>
                    <span class="badge {{ $purchas->payment_status == 'Pending' ? 'badge-danger' : ($purchas->payment_status == 'Paid' ? 'badge-success' : 'badge-warning') }}">{{ $purchas->payment_status }}</span>
                </td>
                <td>{{ $purchas->payment_amount }}</td>
                <td>{{ $purchas->due_amount }}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="data_drop dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item bg-info text-white" href="{{ route('purchas.show', [$purchas->id]) }}" style="border-radius: 10px;"><i class="im im-icon-Eye"></i> View</a>
                            <a class="dropdown-item" href="{{ route('purchas.edit', [$purchas->id]) }}"><i class="im im-icon-Pen"></i> Edit</a>
                            <a href="{{url('purchas/delete/'.$purchas->id.'')}}" class="dropdown-item bg-danger text-white" style="border-radius: 10px;"><i class="im im-icon-Remove"></i> Delete</a>
                            <a href="{{url('purchas/make_payment/'.$purchas->id.'')}}" class="dropdown-item bg-warning text-white" style="border-radius: 10px;"><i class="im im-icon-Add"></i> Make Payment</a>
                            <a href="{{url('purchas/make_payment/'.$purchas->id.'')}}" class="dropdown-item bg-info text-white" style="border-radius: 10px;"><i class="im im-icon-Eye-Invisible"></i> Payment History</a>
                            <a target="_blank" href="{{url('purchas/invoice/'.$purchas->id.'')}}" class="dropdown-item bg-info text-white" style="border-radius: 10px;"><i class="im im-icon-Paper"></i> Invoice</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('footer_scripts')
    @if (Session::has('purchas_id'))
        <script>
            $(document).ready(function () {
                window.open("{{ url('purchas/invoice/' . Session::get('purchas_id')) }}", '_blank');
            });
        </script>
    @endif
@endsection

