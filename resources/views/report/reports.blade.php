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
            <form action="{{ route('generate_report') }}" method="POST" id="report-form">
                @csrf
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
                        <label for="type">Report Type</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="">Select Report Type</option>
                            <option value="sales">Sales Report</option>
                            {{-- <option value="expenses">Expenses Report</option> --}}
                            <option value="purchases">Purchase Report</option>
                            {{-- <option value="income">Income Report</option> --}}
                            <option value="stock">Stock Report</option>
                            <option value="customer_due">Customer Due Report</option>
                            <option value="supplier_due">Supplier Due Report</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="company">Customer</label>
                        <select id="customer_id" name="customer_id" class="form-control">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="company">Supplier</label>
                        <select id="supplier_id" name="supplier_id" class="form-control">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </div>
            </form>
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
                $('#report-form').on('submit', function (e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        url: "{{ route('generate_report') }}",
                        method: 'POST',
                        data: formData,
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
