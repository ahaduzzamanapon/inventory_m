<!-- Date Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('date', 'Date:',['class'=>'control-label']) !!}
        {!! Form::date('date', $logisticBill->date ?? null, ['class' => 'form-control', 'id'=>'date']) !!}
    </div>
</div>

@php
    $users = DB::table('users')->get();
@endphp


<!-- Member Id Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('member_id', 'Select Employee:',['class'=>'control-label']) !!}
        {!! Form::select('member_id', $users->pluck('name', 'id')->prepend('Select Member', ''), null, ['class' => 'form-control', 'onchange' => 'sourceOfPaymentChange()']) !!}
    </div>
</div>





@php
    $accountLedgers = DB::table('accountledgers')->get();
    $advanced_cash = DB::table('advanced_cash')->where('settled_status', '!=', 'Settled')->get();

@endphp


<!-- Account Ledger Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('account_ledgers', 'Ledger:',['class'=>'control-label']) !!}
        {!! Form::select('account_ledgers', $accountLedgers->pluck('name','id')->prepend('Select Account Ledger', ''), null, ['class' => 'form-control']) !!}
    </div>
</div>




@php
$sales = DB::table('sales_models')->get();
$customers = DB::table('customers')->get();
@endphp

<!-- Customer Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('customer', 'Customer:',['class'=>'control-label']) !!}
        {!! Form::select('customer', $customers->pluck('customer_name', 'id')->prepend('Select Customer', ''), null, ['class' => 'form-control', 'onchange' => 'customerChange()']) !!}
    </div>
</div>



<!-- Sale Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('Sale', 'Sale:',['class'=>'control-label']) !!}
        {!! Form::select('Sale',['' => 'Select Sale'], null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Location Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('location', 'Location:',['class'=>'control-label']) !!}
        {!! Form::text('location', null, ['class' => 'form-control','required']) !!}
    </div>
</div>




<!-- Amount Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('amount', 'Amount:',['class'=>'control-label']) !!}
        {!! Form::text('amount', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Attachment Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('attachment', 'Attachment:',['class'=>'control-label']) !!}
        {!! Form::file('attachment') !!}
    </div>
</div>


<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('source_of_payment', 'Source of Payment:',['class'=>'control-label']) !!}
        {!! Form::select('source_of_payment', ['' => 'Select Source', 'Own Cash' => 'Own', 'Advance' => 'Advance'], null, ['class' => 'form-control', 'onchange' => 'sourceOfPaymentChange()']) !!}
    </div>
</div>



<div class="col-md-3 d-none" id="own_cash_div">
    <div class="form-group">
        {!! Form::label('own_cash_amount', 'Own Cash Amount:',['class'=>'control-label']) !!}
        {!! Form::number('own_cash_amount', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-md-3 d-none " id="advance_div">
    <div class="form-group">
        {!! Form::label('advance_id', 'Advance :',['class'=>'control-label']) !!}
        {!! Form::select('advance_id',[''=>'Select Advance'], null, ['class' => 'form-control']) !!}
    </div>
</div>












 <div class="clearfix"></div>


<!-- Note Field -->
<div class="col-md-12">
    <div class="form-group ">
        {!! Form::label('note', 'Note:',['class'=>'control-label']) !!}
        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
    </div>
</div>

@if(can('logistic_bills_approval'))
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('status', 'Status:',['class'=>'control-label']) !!}
        {!! Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved'], null, ['class' => 'form-control']) !!}
    </div>
</div>
@else
<div class="col-md-3 d-none">
    <div class="form-group">
        {!! Form::label('status', 'Status:',['class'=>'control-label']) !!}
        {!! Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved'], null, ['class' => 'form-control']) !!}
    </div>
</div>
@endif


<!-- Submit Field -->
<div class="form-group col-sm-12" style="text-align-last: right;">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('logisticBills.index') }}" class="btn btn-danger">Cancel</a>
</div>

@section('footer_scripts')
<script>
    const sale= @json($sales);
    function customerChange() {
        var id = $('#customer').val();
        var sales = sale.filter(function (item) {
            return item.customer_id == id;
        });
        var salesOptions = sales.map(function (item) {
            return '<option value="' + item.id + '">' + item.sales_id + '</option>';
        });
        $('#Sale').html(salesOptions.join(''));
    }
</script>
<script>
    const advanced_cash= @json($advanced_cash);

    function sourceOfPaymentChange() {
        var  source_of_payment= $('#source_of_payment').val();
        var  member_id= $('#member_id').val();
        if(member_id == null || member_id == ''){
            alert('Please Select Employee');
            return;
        }
        if(source_of_payment == 'Own Cash'){
            $('#own_cash_div').removeClass('d-none');
            $('#advance_div').addClass('d-none');
        }else if(source_of_payment == 'Advance'){
            $('#advance_div').removeClass('d-none');
            $('#own_cash_div').addClass('d-none');

            if(advanced_cash){
            var advanced_cashs = advanced_cash.filter(function (item) {
                return item.member_id == member_id;
            });
            var advanced_cashOptions = advanced_cashs.map(function (item) {
                console.log(item);

                return `<option value="${item.id}">${item.purpose}(${item.amount})</option>`;
            });
            $('#advance_id').html(advanced_cashOptions.join(''));
            }
        }

    }
</script>
<script>
    $(document).ready(function () {
        customerChange();
        sourceOfPaymentChange();
    });
</script>
@endsection


