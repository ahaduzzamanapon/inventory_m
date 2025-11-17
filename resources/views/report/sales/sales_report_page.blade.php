@extends('layouts.default')

@section('title', 'Reports')

@section('content')
<section class="content-header">
    <h1>Generate Reports</h1>
</section>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Filter Reports</h5>
        </div>
        <div class="card-body">
            
                <div class="row">
                    <div class="col-md-3">
                        <label for="from_date">From Date</label>
                        <input type="date" id="from_date" name="from_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="to_date">To Date</label>
                        <input type="date" id="to_date" name="to_date" class="form-control" required>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="company">Customer</label>
                        <select id="customer_id" name="customer_id" class="form-control chosen-select">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" id="generate-report" class="btn btn-primary">Generate Report</button>
                    </div>
                </div>
        </div>
    </div>
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Report Details</h5>
                <a onclick="printReport()" class="btn btn-primary" style="float: right;">Print</a>
            </div>
            <div class="card-body" id="report-view">
            </div>
        </div>
</div>
    @section('scripts')
        <script>
            $(document).ready(function () {
                $('#generate-report').on('click', function (e) {
                    e.preventDefault();
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    var customer_id = $('#customer_id').val();
                    $.ajax({
                        url: "{{ route('reports.sales_report') }}",
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            from_date: from_date,
                            to_date: to_date,
                            customer_id: customer_id
                        },
                        success: function (response) {
                            $('#report-view').html(response);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>
        <script>
            function printReport() {
                var printContents = document.getElementById('report-view').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    @endsection
@endsection
