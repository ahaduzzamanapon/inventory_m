<!-- Date Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('date', 'Date:',['class'=>'control-label']) !!}
        {!! Form::date('date', $pettyCash->date ?? null, ['class' => 'form-control','id'=>'date']) !!}
    </div>
</div>




@php
    $accountLedgers = DB::table('accountledgers')->get();
@endphp


<!-- Account Ledger Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('account_ledgers', 'Account Ledger:',['class'=>'control-label']) !!}
        {!! Form::select('account_ledgers', $accountLedgers->pluck('name','id')->prepend('Select Account Ledger', ''), null, ['class' => 'form-control', 'onchange' => 'accountLedgerChange(this.value)']) !!}
    </div>
</div>

@section('footer_scripts')
    <script>
        var accountLedgers = @json($accountLedgers);
    </script>
    <script type="text/javascript">
        function accountLedgerChange(id) {
            var accountLedger = accountLedgers.find(function (accountLedger) {
                return accountLedger.id == id;
            });
            $('#account_description').val(accountLedger.type);
        }

    </script>
@endsection



<!-- Account Description Field -->
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('account_description', 'Account Description:',['class'=>'control-label']) !!}
        {!! Form::text('account_description', null, ['class' => 'form-control','readonly']) !!}
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
 <div class="clearfix"></div>

@if(can('petty_cash_approval'))
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
    <a href="{{ route('pettyCashes.index') }}" class="btn btn-danger">Cancel</a>
</div>
