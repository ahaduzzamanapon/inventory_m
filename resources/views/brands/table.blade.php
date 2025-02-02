<div class="table-responsive">
    <table class="table data_t" id="brands-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Brand name</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($brands as $key => $brand)
            <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $brand->BrandName }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('brands.show', [$brand->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('brands.edit', [$brand->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>

                        @if(can('delete_option'))
                        {!! Form::open(['route' => ['brands.destroy', $brand->id], 'method' => 'delete']) !!}
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
