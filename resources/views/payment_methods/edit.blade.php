@extends('layouts.default')

{{-- Page title --}}
@section('title')
Payment Method @parent
@stop

@section('content')
   <section class="content-header">
    <div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>{{ __('Edit') }} Payment Method</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="card">
           <div class="card-body">
                <div class="row">
                    {!! Form::model($paymentMethod, ['route' => ['paymentMethods.update', $paymentMethod->id], 'method' => 'patch','class' => 'form-horizontal col-md-12']) !!}
                        <div class="row">
                            @include('payment_methods.fields')
                        </div>
                    {!! Form::close() !!}
                </div>
           </div>
       </div>
   </div>
@endsection
