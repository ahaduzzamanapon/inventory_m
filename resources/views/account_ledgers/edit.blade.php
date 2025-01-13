@extends('layouts.default')

{{-- Page title --}}
@section('title')
Account Ledger @parent
@stop

@section('content')
   <section class="content-header">
    <div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>{{ __('Edit') }} Account Ledger</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="card">
           <div class="card-body">
                <div class="row">
                    {!! Form::model($accountLedger, ['route' => ['accountLedgers.update', $accountLedger->id], 'method' => 'patch','class' => 'form-horizontal col-md-12']) !!}
                        <div class="row">
                            @include('account_ledgers.fields')
                        </div>
                    {!! Form::close() !!}
                </div>
           </div>
       </div>
   </div>
@endsection
