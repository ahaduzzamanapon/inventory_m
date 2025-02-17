@extends('layouts.default')

{{-- Page title --}}
@section('title')
Petty Cash @parent
@stop

@section('content')

<style>
    .custom-card {
        background: linear-gradient(135deg, #13007D, #3819e7);
        border-radius: 15px;
        color: #fff;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .custom-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
    }

    /* Card content */
    .card-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Card title and value */
    .card-title {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        font-weight: bold;
        color: #ffffffdd;
    }

    .card-value {
        font-size: 2.5rem;
        font-weight: 900;
        color: #ffffff;
    }

    /* Card subtitle */
    .card-subtitle {
        font-size: 0.9rem;
        margin-top: 0.5rem;
        opacity: 0.9;
        color: #ffffffcc;
    }

    /* Icon container */
    .icon-container {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        font-size: 1.5rem;
    }

    .icon-container i {
        color: #fff;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .custom-card {
            margin-bottom: 1.5rem;
        }
    }
    </style>
<!-- Content Header (Page header) -->
<section class="content-header">
    {{--<div aria-label="breadcrumb" class="card-breadcrumb">
        <h1>Petty Cash</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>--}}
</section>

<!-- Main content -->
<div class="content">

    @php

    $totalCredit = 0;
    $totalDebit = 0;
    $total_advanced=0;

    foreach ($pettyCashes as $pettyCash) {
        if ($pettyCash->status == 'Approved') {
            if($pettyCash->account_description == 'Credit') {
                $totalCredit += $pettyCash->amount;
            } else {
                $totalDebit += $pettyCash->amount;
            }
            if ($pettyCash->account_ledgers == 2) {
                $total_advanced += $pettyCash->amount;
            }
        }
    }

    $last_petty_cash = DB::table('pettycash')->where('status', 'Approved')->latest()->first();




    @endphp
<div class="col-md-12">
    <div class="row">
        <div class="col-12 col-md-3 col-xxl-3 mb-10" >
            <div class="custom-card">
                <div class="card-body" style="width: 100%;justify-items: center;padding: 0.55rem;">
                    <div class="card-content d-flex align-items-center flex-column">
                            {{-- <h5 class="card-title">{{ $title }}</h5> --}}
                            <h5 class="card-title">Last Credit</h5>
                            @if($last_petty_cash)
                            <h3 class="card-value">{{ number_format($last_petty_cash->amount, 2) }}</h3>
                            @else
                            <h3 class="card-value">0.00</h3>
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-xxl-3 mb-10" >
            <div class="custom-card">
                <div class="card-body" style="width: 100%;justify-items: center;padding: 0.55rem;">
                    <div class="card-content d-flex align-items-center flex-column">
                            {{-- <h5 class="card-title">{{ $title }}</h5> --}}
                            <h5 class="card-title">Total Advanced</h5>
                            <h3 class="card-value">{{ number_format($total_advanced, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-xxl-3 mb-10" >
            <div class="custom-card">
                <div class="card-body" style="width: 100%;justify-items: center;padding: 0.55rem;">
                    <div class="card-content d-flex align-items-center flex-column">
                            {{-- <h5 class="card-title">{{ $title }}</h5> --}}
                            <h5 class="card-title">Total Debit</h5>
                            <h3 class="card-value">{{ number_format($totalDebit, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 col-xxl-3 mb-10" >
            <div class="custom-card">
                <div class="card-body" style="width: 100%;justify-items: center;padding: 0.55rem;">
                    <div class="card-content d-flex align-items-center flex-column">
                            {{-- <h5 class="card-title">{{ $title }}</h5> --}}
                            <h5 class="card-title">Balance</h5>
                            <h3 class="card-value">{{ number_format($totalCredit - $totalDebit, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>






    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>







    <div class="card" width="88vw;">
        <section class="card-header">
            <h5 class="card-title d-inline">Petty Cash</h5>
            <span class="float-right">
                <a class="btn btn-primary pull-right" href="{{ route('pettyCashes.create') }}">Add New</a>
            </span>
        </section>
        <div class="card-body table-responsive" >
            @include('petty_cashes.table')
        </div>
    </div>

</div>
@endsection
