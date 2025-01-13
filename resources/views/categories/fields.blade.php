<!-- Name Field -->
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('Name', 'Name:',['class'=>'control-label']) !!}
        {!! Form::text('Name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
</div>
