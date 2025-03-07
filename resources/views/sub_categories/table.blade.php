<div class="table-responsive">
    <table class="table data_t" id="subCategories-table">
        <thead>
            <tr>
                <th>SL</th>
        <th>Sub-category Name</th>
        <th>Category</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subCategories as $key => $subCategory)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ $subCategory->SubCategoryName }}</td>
            <td>{{ $subCategory->CategoryName }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('subCategories.show', [$subCategory->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('subCategories.edit', [$subCategory->id]) }}" class='btn btn-outline-primary btn-xs'><i
                            class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                            @if(can('delete_option'))
                                {!! Form::open(['route' => ['subCategories.destroy', $subCategory->id], 'method' => 'delete']) !!}
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
