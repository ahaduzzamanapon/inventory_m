@extends('layouts.default')

@section('title', 'Ledger')

@section('content')
    <section class="content-header">
        <h1>Ledger</h1>
    </section>

    <div class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Ledger</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="customer_id">Select Customer</label>
                    <select id="customer_id" class="form-control chosen-select">
                        <option value="">Select Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" data-opening-balance="{{ $customer->opening_balance }}">
                                {{ $customer->customer_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="ledger-content"></div>

                <div class="mt-4">
                    <button id="print_report" class="btn btn-primary" style="display: none;">Print Report</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="addTransactionModal" tabindex="-1" role="dialog"
        aria-labelledby="addTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransactionModalLabel">Add Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addTransactionForm">
                        @csrf
                        <input type="hidden" name="customer_id" id="modal_customer_id">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                     
                        <div class="form-group">
                            <label for="paid_amount"> Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01" value="0.00">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveTransaction">Save Transaction</button>
                </div>
            </div>
        </div>
    </div>

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            var customerId;
            $('#customer_id').on('change', function() {
                customerId = $(this).val();
                if (customerId) {
                    $('#modal_customer_id').val(customerId);
                    loadTransactions(customerId);
                }
            });

            $('#addTransactionModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var customerId = $('#customer_id').val();
                var modal = $(this)
                modal.find('.modal-body #modal_customer_id').val(customerId)
            })

            $('#saveTransaction').on('click', function() {
                $.ajax({
                    url: "{{ route('ledger.transaction.store') }}",
                    type: 'POST',
                    data: $('#addTransactionForm').serialize(),
                    success: function(data) {
                        $('#addTransactionModal').modal('hide');
                        loadTransactions(customerId);
                    }
                });
            });

            $('#get_report').on('click', function() {
                var customerId = $('#customer_id').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (customerId) {
                    var url = '/ledger/report/' + customerId + '?from_date=' + from_date + '&to_date=' +
                        to_date;
                    window.open(url, '_blank');
                }
            });

            function loadTransactions(customerId) {

                $.ajax({

                    url: '/ledger/transactions/' + customerId,

                    type: 'GET',

                    success: function(data) {

                        var opening_balance = parseFloat(data.opening_balance);

                        var transactions = data.transactions;

                        var html =
                            `

                            <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#addTransactionModal">
                                Add Transaction
                            </button>
                            
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Bill Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                        if (transactions.length == 0) {

                            html +=
                                '<tr><td colspan="4" class="text-right"><strong>Opening Balance</strong></td><td><input type="number" id="opening_balance_input" value="' +
                                opening_balance.toFixed(2) + '" class="form-control"></td></tr>';

                        } else {

                            html +=
                                '<tr><td colspan="4" class="text-right"><strong>Opening Balance</strong></td><td><strong>' +
                                opening_balance.toFixed(2) + '</strong></td></tr>';

                        }

                        $.each(transactions, function(index, transaction) {


                            if (transaction.transaction_type == 'sales') {

                                   html += '<tr><td>' + transaction.date + '</td><td>' + transaction
                                    .description + '</td><td>' + transaction.amount + '</td><td>0</td><td>' +
                                    transaction.balance + '</td></tr>';

                               
                            }else{
                              html += '<tr><td>' + transaction.date + '</td><td>' + transaction
                                    .description + '</td><td>0</td><td>' + transaction.amount + '</td><td>' +
                                    transaction.balance + '</td></tr>';
                            }

                        });


                        html += '</tbody></table>';

                        if (transactions.length == 0) {

                            html +=
                                '<button id="update_opening_balance" class="btn btn-primary">Update Opening Balance</button>';

                        }

                        $('#ledger-content').html(html);

                        $('#print_report').show();

                    }

                });

            }



            $(document).on('click', '#update_opening_balance', function() {

                var customerId = $('#customer_id').val();

                var opening_balance = $('#opening_balance_input').val();

                $.ajax({

                    url: '/ledger/opening-balance/' + customerId,

                    type: 'POST',

                    data: {

                        _token: "{{ csrf_token() }}",

                        opening_balance: opening_balance

                    },

                    success: function(data) {

                        if (data.success) {

                            loadTransactions(customerId);

                        } else {

                            alert(data.message);

                        }

                    }

                });

            });



            $('#print_report').on('click', function() {

                var printContents = document.getElementById('ledger-content').innerHTML;

                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;

            });

        });
    </script>
@endsection
@endsection
