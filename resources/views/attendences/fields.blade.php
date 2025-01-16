<!-- Date Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('date', 'Date:',['class'=>'control-label']) !!}
        {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
    </div>
</div>

@php
    $users = DB::table('users')->get();
@endphp


<div class="col-md-12 table-responsive">
    <table class="table table-light table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>SL</th>
                <th>Emp Id</th>
                <th>Name</th>
                <th>Present Status</th>
                <th>Late Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->emp_id }}</td>
                    <td>{{ $user->name.' '.$user->last_name }}</td>
                    <td>
                        <div class="form-group">
                            <input type="hidden" name="emp_id[]" value="{{ $user->id }}">
                            <select name="status[]" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="Absent">Absent</option>
                                <option value="Present">Present</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <select name="late_status[]" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('attendences.index') }}" class="btn btn-danger">Cancel</a>
</div>
