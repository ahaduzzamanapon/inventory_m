<div class="table-responsive">
    <table class="table data_t" id="items-table">
        <thead>
            <tr>
        <th>Sl</th>
        <th>Id</th>
        <th>Name</th>
        <th>Image</th>
        <th>Category</th>
        <th>Sub Category</th>
        <th>Model</th>
        <th>Brand</th>
        <th>Company</th>
        <th>Qty</th>
        <th>Unit</th>
        @if(can('view_item_purchase_price'))
        <th>Purchase Price</th>
            @endif
        @if(can('view_item_sale_price'))
            <th>Sale Price</th>
            @endif
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $key => $item)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->item_id }}</td>
            <td>{{ $item->item_name }}</td>
            <td><img src="{{asset($item->item_image)}}" alt="" width="100"></td>
            <td>{{ $item->CategoryName }}</td>
            <td>{{ $item->SubCategoryName }}</td>
            <td>{{ $item->item_model }}</td>
            <td>{{ $item->BrandName }}</td>
            <td>{{ $item->CompanyName }}</td>
            <td>{{ $item->item_qty }}</td>
            <td>{{ $item->Unit_Name }}</td>
                    @if(can('view_item_purchase_price'))

            <td>{{ $item->item_purchase_price }}</td>
            @endif
            @if(can('view_item_sale_price'))
            <td>{{ $item->item_sale_price }}</td>
            @endif
                <td>
                    {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
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
