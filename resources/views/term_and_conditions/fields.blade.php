<!-- Title Field -->
<div class="col-md-12">
    <div class="form-group ">
        {!! Form::label('Title', 'Title:',['class'=>'control-label']) !!}
        {!! Form::textarea('Title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Title Field -->
<div class="col-md-12">
    <div class="form-group ">
        {!! Form::label('status', 'Status:',['class'=>'control-label']) !!}
        {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control']) !!}
    </div>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('termAndConditions.index') }}" class="btn btn-danger">Cancel</a>
</div>
