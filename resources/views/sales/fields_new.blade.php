


<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <div class="form-group col-md-12">
                    {!! Form::label('customer_id', 'Customer:') !!}
                    {!! Form::select('customer_id', $customers, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-12">
                    {!! Form::label('sale_date', 'Date:') !!}
                    {!! Form::date('sale_date', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <div class="form-group col-md-12">
                    {!! Form::label('reference_no', 'Reference:') !!}
                    {!! Form::text('reference_no',  'Ref-' . time(), ['class' => 'form-control', 'placeholder' => 'Reference Number']) !!}
                </div>
                <div class="form-group col-md-12">
                    {!! Form::label('sales_id', 'Sales ID:') !!}
                    {!! Form::text('sales_id', 'sale-' . time(), ['class' => 'form-control', 'placeholder' => 'Sales ID', 'readonly']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="form-group col-md-12">
                    {!! Form::select('select_item_id', $items, null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#select_item_id').chosen();
        });
    </script>
@endsection
