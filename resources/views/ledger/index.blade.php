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
                    <label for="organization_id">Select Organization</label>
                    <select id="organization_id" class="form-control chosen-select">
                        <option value="">Select Organization</option>
                        @foreach ($organizations ?? [] as $organization)
                            <option value="{{ $organization->id }}">
                                {{ $organization->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <button id="add_transaction_btn" class="btn btn-success" style="display: none;" data-toggle="modal"
                        data-target="#transactionModal">Add Transaction</button>
                    <button id="print_report" class="btn btn-primary" style="display: none;">Print Report</button>
                </div>

                <div id="ledger-content"></div>
            </div>
        </div>
    </div>

    <!-- Transaction Modal -->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Add Ledger Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="transaction_form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="transaction_type">Type</label>
                            <select name="transaction_type" id="modal_transaction_type" class="form-control" required>
                                <option value="receivable">Receivable</option>
                                <option value="payable">Payable</option>
                            </select>
                        </div>
                        <input type="hidden" name="organization_id" id="modal_organization_id">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Transaction</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('footer_scripts')
        <script>
            $(document).ready(function () {
                var organizationId;

                $('#organization_id').on('change', function () {
                    organizationId = $(this).val();
                    if (organizationId) {
                        $('#add_transaction_btn').show();
                        loadTransactions({ organization_id: organizationId });
                        // Set organization ID in modal
                        $('#modal_organization_id').val(organizationId);
                    } else {
                        $('#ledger-content').html('');
                        $('#print_report').hide();
                        $('#add_transaction_btn').hide();
                    }
                });

                // Removed member loading logic as per user request

                $('#transaction_form').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/ledger/transaction/store',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function (data) {
                            if (data.success) {
                                $('#transactionModal').modal('hide');
                                $('#transaction_form')[0].reset();
                                // Reset the hidden organization id as reset() clears it? No, hidden inputs are not cleared by standard reset usually if not part of form?
                                // Actually reset() clears all form fields including hidden ones IF they have a value attribute?
                                // Better re-set it just in case:
                                $('#modal_organization_id').val(organizationId);

                                loadTransactions({ organization_id: organizationId });
                                alert('Transaction saved successfully!');
                            }
                        }
                    });
                });

                function loadTransactions(params) {
                    $.ajax({
                        url: '/ledger/transactions',
                        type: 'GET',
                        data: params,
                        success: function (data) {
                            var opening_balance = parseFloat(data.opening_balance);
                            var transactions = data.transactions;
                            var html = `
                                                                        <table class="table table-bordered table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Date</th>
                                                                                    <th>Description</th>
                                                                                    <th>Sales</th>
                                                                                    <th>Purchase</th>
                                                                                    <th>Receivable</th>
                                                                                    <th>Payable</th>
                                                                                    <th>Balance Amount</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>`;

                            html += '<tr><td colspan="6" class="text-right"><strong>Opening Balance</strong></td><td><strong>' +
                                opening_balance.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</strong></td></tr>';

                            $.each(transactions, function (index, transaction) {
                                html += '<tr>' +
                                    '<td>' + transaction.date + '</td>' +
                                    '<td>' + transaction.description + '</td>' +
                                    '<td>' + (transaction.sales ? transaction.sales : '') + '</td>' +
                                    '<td>' + (transaction.purchase ? transaction.purchase : '') + '</td>' +
                                    '<td>' + (transaction.receivable ? transaction.receivable : '') + '</td>' +
                                    '<td>' + (transaction.payable ? transaction.payable : '') + '</td>' +
                                    '<td>' + transaction.balance + '</td>' +
                                    '</tr>';
                            });

                            html += '</tbody></table>';
                            $('#ledger-content').html(html);
                            $('#print_report').show();
                        }
                    });
                }

                $('#print_report').on('click', function () {
                    var printContents = document.getElementById('ledger-content').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                    window.location.reload();
                });
            });
        </script>
    @endsection
@endsection