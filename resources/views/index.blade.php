@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Dashboard @parent
@stop
{{-- page level styles --}}
@section('header_styles')

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
            <h1>Dashboard</h1>

        </div>
        <div class="separator-breadcrumb border-top"></div>--}}
    </section>
    <!-- /.content -->

    @if(can('dashboard'))
    <section class="content">
        <div class="container-lg col-md-12">
            <div class="row">
                <?php
                $metrics = [
                    'Monthly Sales' => DB::table('sales_models')
                        ->whereMonth('created_at', now()->month)
                        ->count(),
                    'Monthly Expense' => DB::table('pettycash')
                        ->whereMonth('created_at', now()->month)
                        ->sum('amount'),
                    'Total Liability' => DB::table('purchas_models')
                        ->whereMonth('created_at', now()->month)
                        ->count(),
                    'Running Petty cash' => DB::table('pettycash')
                        ->where('status', 'Pending')
                        ->count(),
                    'Total Advance' => DB::table('advanced_cash')
                        ->sum('amount'),
                    'Total Item' => DB::table('items')
                        ->count(),
                    'Total Product Value' => DB::table('items')
                        ->sum(DB::raw('item_qty * item_purchase_price')),
                    'Total Due' => DB::table('sales_models')
                        ->sum('due_amount'),
                    'Total Yearly Profit' => DB::table('sales_payment_models')
                        ->whereYear('created_at', now()->year)
                        ->where('payment_status', 'Completed')
                        ->sum('payment_amount'),
                ];

                $icons = [
                    'Monthly Sales' => 'fas fa-dollar-sign',
                    'Monthly Expense' => 'fas fa-money-bill',
                    'Total Due' => 'fas fa-credit-card',
                    'Total Advance' => 'fas fa-forward',
                    'Total Product Value' => 'fas fa-boxes',
                    'Total Yearly Profit' => 'fas fa-chart-line',
                    'Total Liability' => 'fas fa-credit-card',
                    'Total Item' => 'fas fa-boxes',
                    'Running Petty cash' => 'fas fa-money-bill',


                ];

                $subtitles = [
                    'Monthly Sales' => 'Sales made this month',
                    'Monthly Expense' => 'Expenses this month',
                    'Total Due' => 'Outstanding dues',
                    'Total Advance' => 'Total advanced payments',
                    'Total Product Value' => 'Value of all products in stock',
                    'Total Yearly Profit' => 'Profit made this year',
                    'Total Liability' => 'Total liabilities',
                    'Total Item' => 'Total items in stock',
                    'Running Petty cash' => 'Running petty cash',
                ];
                $permissions=[
                    'Monthly Sales' => 'monthly_sales',
                    'Monthly Expense' => 'monthly_expense',
                    'Total Due' => 'total_due',
                    'Total Advance' => 'total_advance',
                    'Total Product Value' => 'total_product_value',
                    'Total Yearly Profit' => 'total_yearly_profit',
                    'Total Liability' => 'total_liability',
                    'Total Item' => 'total_item',
                    'Running Petty cash' => 'running_petty_cash',
                ];
                ?>

                    @foreach ($metrics as $title => $value)
                    @if(!can($permissions[$title]))
                    @continue
                    @endif
                    <div class="col-12 col-md-4 col-xxl-3 mb-10">
                        <div class="custom-card">
                            <div class="card-body">
                                <div class="card-content d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title">{{ $title }}</h5>
                                        <h3 class="card-value">{{ number_format($value, 2) }}</h3>
                                    </div>
                                    <div class="icon-container">
                                        <i class="{{ $icons[$title] }}"></i>
                                    </div>
                                </div>
                                <p class="card-subtitle">{{ $subtitles[$title] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

        </div>
    </section>
    @endif

@stop
@section('footer_scripts')
    <!--   page level js ----------->
    <script language="javascript" type="text/javascript" src="{{ asset('vendors/chartjs/js/Chart.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>

    <!-- end of page level js -->
@stop
