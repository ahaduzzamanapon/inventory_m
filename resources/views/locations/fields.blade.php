<!-- Location Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('location_name', 'Location Name:',['class'=>'control-label']) !!}
        {!! Form::text('location_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Location Address Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('location_address', 'Location Address:',['class'=>'control-label']) !!}
        {!! Form::text('location_address', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('locations.index') }}" class="btn btn-danger">Cancel</a>
</div>
