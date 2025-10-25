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
.custom-modal {
    display: none; 
    position: fixed; 
    z-index: 9999; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    background-color: rgba(0,0,0,0.4); 
}

.custom-modal-content {
    background-color: #fefefe;
    margin: 5% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%; 
    max-width: 1200px;
    border-radius: 10px;
    max-height: 90vh;
    overflow: auto;
}

.custom-modal-close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.custom-modal-close:hover,
.custom-modal-close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.custom-modal-footer {
    padding: 15px;
    text-align: right;
    border-top: 1px solid #e5e5e5;
}
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


    $totalCredit = 0;
    $totalDebit = 0;

    $pettyCashes = DB::table('pettycash')->get();

    foreach ($pettyCashes as $pettyCash) {
        if ($pettyCash->status == 'Approved') {
            if($pettyCash->account_description == 'Credit') {
                $totalCredit += $pettyCash->amount;
            } else {
                $totalDebit += $pettyCash->amount;
            }
        }
    }

    // Schema::create('comissions', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->string('date');
    //         $table->string('purpose');
    //         $table->string('employee');
    //         $table->string('customer');
    //         $table->float('amount');
    //         $table->text('note');
    //         $table->timestamps();
    //     });


    $totalSales = DB::table('sales_models')
                        ->sum('grand_total');

    $totalPurchases = DB::table('purchas_models')
                        ->sum('grand_total');
    $totalDue = DB::table('purchas_models')
                        ->sum('due_amount');





                $metrics = [
                    'Monthly Sales' => DB::table('sales_models')
                        ->whereMonth('sale_date', now()->month)
                        ->sum('grand_total'),
                    'Monthly Expense' => DB::table('logistic_bills')
                        ->whereMonth('date', now()->month)
                        ->where('status', 'Approved')
                        ->sum('amount'),
                    'Total Liability' =>$totalDue ,
                    'Running Petty cash' => $totalCredit - $totalDebit,
                    'Total Advance' => DB::table('advanced_cash')
                        ->where('status', 'Approved')
                        ->sum('amount'),
                    'Total Item' => DB::table('items')
                        ->count(),
                        
                    'Total Product Value' => DB::table('items')
                        ->sum(DB::raw('item_qty * item_purchase_price')),

                    'Total sales Due' => DB::table('sales_models')
                        ->sum('due_amount'),

                    'Total Yearly Profit' => $totalSales - $totalPurchases,
                    'Total Yearly Sales' => DB::table('sales_models')
                        ->whereYear('sale_date', now()->year)
                        ->sum('grand_total'),
                    'Total Yearly Expenses' => DB::table('logistic_bills')
                        ->whereYear('date', now()->year)
                        ->where('status', 'Approved')
                        ->sum('amount'),
                    'Total Net Profit' => DB::table('sales_models')
                        ->whereYear('sale_date', now()->year)
                        ->sum('grand_total') - DB::table('logistic_bills')
                        ->whereYear('date', now()->year)
                        ->where('status', 'Approved')
                        ->sum('amount'),
                ];

                $icons = [
                    'Monthly Sales' => 'fas fa-dollar-sign',
                    'Monthly Expense' => 'fas fa-money-bill',
                    'Total sales Due' => 'fas fa-credit-card',
                    'Total Advance' => 'fas fa-forward',
                    'Total Product Value' => 'fas fa-boxes',
                    'Total Yearly Profit' => 'fas fa-chart-line',
                    'Total Liability' => 'fas fa-credit-card',
                    'Total Item' => 'fas fa-boxes',
                    'Running Petty cash' => 'fas fa-money-bill',
                    'Total Yearly Sales' => 'fas fa-chart-line',
                    'Total Yearly Expenses' => 'fas fa-money-bill',
                    'Total Net Profit' => 'fas fa-chart-line',
                    


                ];

                $subtitles = [
                    'Monthly Sales' => 'Sales made this month',
                    'Monthly Expense' => 'Expenses this month',
                    'Total sales Due' => 'Outstanding dues',
                    'Total Advance' => 'Total advanced payments',
                    'Total Product Value' => 'Value of all products in stock',
                    'Total Yearly Profit' => 'Profit made this year',
                    'Total Liability' => 'Total liabilities',
                    'Total Item' => 'Total items in stock',
                    'Running Petty cash' => 'Running petty cash',
                    'Total Yearly Sales' => 'Total sales this year',
                    'Total Yearly Expenses' => 'Total expenses this year',
                    'Total Net Profit' => 'Net Profit',
                ];
                $permissions=[
                    'Monthly Sales' => 'monthly_sales',
                    'Monthly Expense' => 'monthly_expense',
                    'Total sales Due' => 'total_due',
                    'Total Advance' => 'total_advance',
                    'Total Product Value' => 'total_product_value',
                    'Total Yearly Profit' => 'total_yearly_profit',
                    'Total Liability' => 'total_liability',
                    'Total Item' => 'total_item',
                    'Running Petty cash' => 'running_petty_cash',
                    'Total Yearly Sales' => 'total_yearly_sales',
                    'Total Yearly Expenses' => 'total_yearly_expenses',
                    'Total Net Profit' => 'total_net_profit',
                ];
                ?>

                    @foreach ($metrics as $title => $value)
                    @if(!can($permissions[$title]))
                    @continue
                    @endif
                    <div class="col-12 col-md-4 col-xxl-3 mb-10">
                                            <div class="custom-card" style="position: relative;">
                                                <button class="btn btn-secondary btn-sm get-report-btn" data-title="{{ $title }}" style="position: absolute; top: 10px; right: 10px;">Get Report</button>
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
                                            </div>                    </div>
                    @endforeach

        </div>
    </section>
    @endif

@stop
@section('footer_scripts')
    <!--   page level js ----------->
    <script language="javascript" type="text/javascript" src="{{ asset('vendors/chartjs/js/Chart.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>

    <div id="customReportModal" class="custom-modal">
  <div class="custom-modal-content">
    <span class="custom-modal-close">&times;</span>
    <div id="custom-report-content"></div>
    <div class="custom-modal-footer">
        <button type="button" class="btn btn-secondary custom-modal-close-btn">Close</button>
        <button type="button" class="btn btn-primary" id="export-pdf-btn">Export to PDF</button>
    </div>
  </div>
</div>

    <script>
    // Get the modal
    var modal = document.getElementById("customReportModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("custom-modal-close")[0];
    var closeBtn = document.getElementsByClassName("custom-modal-close-btn")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    $(document).on('click', '.get-report-btn', function() {
        var title = $(this).data('title');
        var url = '{{ route("report.generate") }}?title=' + title;
        
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#custom-report-content').html(response);
                $('#export-pdf-btn').data('title', title);
                modal.style.display = "block";
            }
        });
    });

    $(document).on('click', '#export-pdf-btn', function() {
        var title = $(this).data('title');
        var url = '{{ route("report.downloadPdf") }}?title=' + title;
        window.location.href = url;
    });
    </script>
    <!-- end of page level js -->
@stop
