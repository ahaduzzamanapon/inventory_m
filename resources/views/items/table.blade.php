<div class="table-responsive">
    <table class="table" id="items-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Item Id</th>
        <th>Item Name</th>
        <th>Item Category</th>
        <th>Item Sub Category</th>
        <th>Item Model</th>
        <th>Item Qty</th>
        <th>Item Unit</th>
        <th>Item Purchase Price</th>
        <th>Item Sale Price</th>
        <th>Item Company Id</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $key => $item)
            <tr>
                <td>{{ $item->id }}</td>
            <td>{{ $item->item_id }}</td>
            <td>{{ $item->item_name }}</td>
            <td>{{ $item->item_category }}</td>
            <td>{{ $item->item_sub_category }}</td>
            <td>{{ $item->item_model }}</td>
            <td>{{ $item->item_qty }}</td>
            <td>{{ $item->item_unit }}</td>
            <td>{{ $item->item_purchase_price }}</td>
            <td>{{ $item->item_sale_price }}</td>
            <td>{{ $item->item_company_id }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
                <td>
                    {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('items.show', [$item->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('items.edit', [$item->id]) }}" class='btn btn-outline-primary btn-xs'><i
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
