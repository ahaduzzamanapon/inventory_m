<!-- Unit Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('Unit_Name', 'Unit Name:',['class'=>'control-label']) !!}
        {!! Form::text('Unit_Name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('units.index') }}" class="btn btn-danger">Cancel</a>
</div>
