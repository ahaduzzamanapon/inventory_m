<!-- Date Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('date', 'Date:',['class'=>'control-label']) !!}
        {!! Form::date('date', $date , ['class' => 'form-control','id'=>'date']) !!}
    </div>
</div>



<div class="col-md-12 table-responsive">
    <table class="table table-light table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>SL</th>
                <th>Emp Id</th>
                <th>Name</th>
                <th>Present Status</th>
                <th>Late Status</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendence as $key => $user)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->u_emp_id }}</td>
                    <td>{{ $user->name.' '.$user->last_name }}</td>
                    <td>
                        <div class="form-group">
                            <input type="hidden" name="emp_id[]" value="{{ $user->u_id }}">
                            <select name="status[]" class="form-control" required>
                                <option  value="">Select Status</option>
                                <option {{ $user->status == 'Absent' ? 'selected' : ''}} value="Absent">Absent</option>
                                <option  {{ $user->status == 'Present' ? 'selected' : ''}} value="Present">Present</option>
                                <option  {{ $user->status == 'Leave' ? 'selected' : ''}} value="Leave">Leave</option>
                                <option  {{ $user->status == 'Tour' ? 'selected' : ''}} value="Tour">Tour</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <select name="late_status[]" class="form-control" required>
                                <option value="">Select Status</option>
                                <option {{ $user->late_status == 'No' ? 'selected' : ''}} value="No">No</option>
                                <option {{ $user->late_status == 'Yes' ? 'selected' : ''}} value="Yes">Yes</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="late_time[]" value="{{ $user->late_time }}" class="form-control">
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
