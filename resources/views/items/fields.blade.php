<!-- Item Id Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_id', 'Item Id:', ['class' => 'control-label']) !!}
        {!! Form::text('item_id', 'IT' . time(), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>


<!-- Item Name Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_name', 'Item Name:', ['class' => 'control-label']) !!}
        {!! Form::text('item_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<?php
$categories = DB::table('categorys')->get();
$subcategories = DB::table('subcategorys')->get();
?>


<!-- Item Category Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_category', 'Item Category:', ['class' => 'control-label']) !!}
        {!! Form::select('item_category', $categories->pluck('Name', 'id')->prepend('Select Category', ''), null, [
            'class' => 'form-control',
            'onchange' => 'categoryChange(this.value)',
        ]) !!}
    </div>
</div>


<!-- Item Sub Category Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_sub_category', 'Item Sub Category:', ['class' => 'control-label']) !!}
        {!! Form::select('item_sub_category', ['' => 'Select'], null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Item Model Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_model', 'Item Model:', ['class' => 'control-label']) !!}
        {!! Form::text('item_model', null, ['class' => 'form-control']) !!}
    </div>
</div>




<?php
$units = DB::table('units')->get();
?>

<!-- Item Unit Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_unit', 'Item Unit:', ['class' => 'control-label']) !!}
        {!! Form::select('item_unit', $units->pluck('Unit_Name', 'id')->prepend('Select Unit', ''), null, ['class' => 'form-control']) !!}
    </div>
</div>


@if(can('view_item_purchase_price'))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_purchase_price', 'Item Purchase Price:', ['class' => 'control-label']) !!}
        {!! Form::text('item_purchase_price', null, ['class' => 'form-control']) !!}
    </div>
</div>
@else
<div class="col-md-3 d-none">
    <div class="form-group">
        {!! Form::label('item_purchase_price', 'Item Purchase Price:', ['class' => 'control-label']) !!}
        {!! Form::text('item_purchase_price', null, ['class' => 'form-control']) !!}
    </div>
</div>
@endif


@if(can('view_item_sale_price'))
<!-- Item Sale Price Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_sale_price', 'Item Sale Price:', ['class' => 'control-label']) !!}
        {!! Form::text('item_sale_price', null, ['class' => 'form-control']) !!}
    </div>
</div>
@else
<div class="col-md-3 d-none">
    <div class="form-group">
        {!! Form::label('item_sale_price', 'Item Sale Price:', ['class' => 'control-label']) !!}
        {!! Form::text('item_sale_price', null, ['class' => 'form-control']) !!}
    </div>
</div>
@endif

<?php
$companies = DB::table('companies')->get();
?>


<!-- Item Company Id Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_company_id', 'Item Company Id:', ['class' => 'control-label']) !!}
        {!! Form::select('item_company_id', $companies->pluck('companie_name', 'id')->prepend('Select Company', ''), null, ['class' => 'form-control']) !!}
    </div>
</div>

<?php
$brands = DB::table('brands')->get();

?>


<!-- Item Company Id Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_brand_id', 'Item Brand:', ['class' => 'control-label']) !!}
        {!! Form::select('item_brand_id', $brands->pluck('BrandName', 'id')->prepend('Select Brand', ''), null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        @if(isset($item))
        <img src="{{asset($item->item_image)}}" class="img-fluid" alt="">
        @endif
        {!! Form::label('item_image', 'Item Image:', ['class' => 'control-label']) !!}
        {!! Form::file('item_image') !!}
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_stock_alert_level', 'Item Stock Alert Level:', ['class' => 'control-label']) !!}
        {!! Form::number('item_stock_alert_level', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_origin', 'Item Origin:', ['class' => 'control-label']) !!}
        {!! Form::text('item_origin', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_warranty', 'Item Warranty:', ['class' => 'control-label']) !!}
        {!! Form::text('item_warranty', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_variant_status', 'Item Variant Status:', ['class' => 'control-label']) !!}
        {!! Form::select('item_variant_status', ['1' => 'Single Variant', '2' => 'Multi Variant'], null, ['class' => 'form-control', 'onkeyup' => 'serialNumberDiv()']) !!}
    </div>
</div>
<!-- Item Qty Field -->

@if(isset($edit))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_qty', 'Item Qty:', ['class' => 'control-label']) !!}
        {!! Form::number('item_qty', null, ['class' => 'form-control', 'onkeyup' => 'serialNumberDiv()', 'readonly']) !!}
    </div>
</div>
@else
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('item_qty', 'Item Qty:', ['class' => 'control-label']) !!}
        {!! Form::number('item_qty', null, ['class' => 'form-control', 'onkeyup' => 'serialNumberDiv()']) !!}
    </div>
</div>
@endif


<div class="col-md-12 serial_number_div">
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('items.index') }}" class="btn btn-danger">Cancel</a>
</div>

<?php

?>

@section('footer_scripts')
<script>
    var subcategories = @json($subcategories);
    var subid = @js(isset($item) ? $item->item_sub_category : null);

    console.log(subcategories);  // Log to check the structure of subcategories
    $(document).ready(function () {
        $('#item_category').change();
    });
</script>

<script type="text/javascript">
function categoryChange(id) {
    // Find all subcategories that match the selected category ID
    var matchedSubcategories = subcategories.filter(function (subcategory) {
        return subcategory.Category == id;
    });

    // Log the matched subcategories
    console.log(matchedSubcategories);

    // Check if there are any subcategories for the selected category
    if (matchedSubcategories.length > 0) {
        // Create options for subcategories
        var options = '<option value="select">Select Sub Category</option>';
        matchedSubcategories.forEach(function (sub) {
            if (sub.id == subid) {
                options += '<option value="' + sub.id + '" selected>' + sub.SubCategoryName + '</option>';
            }else{
                options += '<option value="' + sub.id + '">' + sub.SubCategoryName + '</option>';
            }
        });

        // Set the options in the dropdown
        $('#item_sub_category').html(options);
    } else {
        // If no subcategories found for the selected category, show a default message
        $('#item_sub_category').html('<option value="select">No Sub Categories Available</option>');
    }
}
</script>
<script>
        function serialNumberDiv() {
            var variantStatus = $('#item_variant_status').val();
            if (variantStatus == 2) {
                var qty = $('#item_qty').val();
                var serialNumberDiv = '';
                for (let i = 0; i < qty; i++) {
                    serialNumberDiv += `
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="item_serial_number">Item Serial Number ${i + 1}:</label>
                            <input type="text" name="item_serial_number[]" class="form-control">
                        </div>
                    </div>
                    `;
                }
                $('.serial_number_div').html(serialNumberDiv);
            } else {
                $('.serial_number_div').html('');
            }
        }

</script>


@endsection
