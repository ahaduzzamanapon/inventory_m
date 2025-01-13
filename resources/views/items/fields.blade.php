<!-- Item Id Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_id', 'Item Id:',['class'=>'control-label']) !!}
        {!! Form::text('item_id', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_name', 'Item Name:',['class'=>'control-label']) !!}
        {!! Form::text('item_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Category Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_category', 'Item Category:',['class'=>'control-label']) !!}
        {!! Form::select('item_category', ['select' => 'select'], null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Sub Category Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_sub_category', 'Item Sub Category:',['class'=>'control-label']) !!}
        {!! Form::select('item_sub_category', ['selct' => 'selct'], null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Model Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_model', 'Item Model:',['class'=>'control-label']) !!}
        {!! Form::text('item_model', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Qty Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_qty', 'Item Qty:',['class'=>'control-label']) !!}
        {!! Form::number('item_qty', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Unit Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_unit', 'Item Unit:',['class'=>'control-label']) !!}
        {!! Form::select('item_unit', ['select' => 'select'], null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Purchase Price Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_purchase_price', 'Item Purchase Price:',['class'=>'control-label']) !!}
        {!! Form::text('item_purchase_price', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Sale Price Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_sale_price', 'Item Sale Price:',['class'=>'control-label']) !!}
        {!! Form::text('item_sale_price', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Company Id Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_company_id', 'Item Company Id:',['class'=>'control-label']) !!}
        {!! Form::select('item_company_id', ['select' => 'select'], null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('items.index') }}" class="btn btn-danger">Cancel</a>
</div>
