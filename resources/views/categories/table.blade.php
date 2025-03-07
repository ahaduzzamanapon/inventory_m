<div class="table-responsive">
    <table class="table data_t" id="categories-table">
        <thead>
            <tr>
                <th>Sl</th>
        <th>Name</th>

                <th >Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $key => $category)
            <tr>
                <td>{{ $key + 1 }}</td>
            <td>{{ $category->Name }}</td>

                <td>
                    <div class='btn-group'>
                        <a href="{{ route('categories.show', [$category->id]) }}" class='btn btn-outline-primary btn-xs'><i class="im im-icon-Eye" data-placement="top" title="View"></i></a>
                        <a href="{{ route('categories.edit', [$category->id]) }}" class='btn btn-outline-primary btn-xs'><i
                                class="im im-icon-Pen"  data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                @if(can('delete_option'))
                                {!! Form::open(['route' => ['brands.destroy', $category->id], 'method' => 'delete']) !!}
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
