@extends('layouts.default')
{{-- Page title --}}
@section('title')
Item Dashboard @parent
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
            <button id="" class="btn btn-info mb-3" data-toggle="modal" data-target="#hiddenItemsModal">Manage Hidden Items</button>
            <div class="row">
                @foreach($items as $item)
                <div class="col-12 col-md-3 col-xxl-3 mb-10 item-card" data-item-id="{{ $item->id }}" @if($item->is_hidden) style="display: none;" @endif>
                    <div class="custom-card" style="background: {{($item->item_qty < $item->item_stock_alert_level) ? '#ff0000' : ''}}; position: relative;">
                        
                        <div style="display: flex;justify-content: right;gap: 10px;margin: 7px;">
                            <a style="background-color: beige;" href="{{ route('item.report', $item->id) }}" class="btn  btn-sm"  target="_blank">Get Report</a>
                            <button style="background-color: revert;" class="btn  btn-sm toggle-item-visibility" data-item-id="{{ $item->id }}">{{ $item->is_hidden ? 'Show' : 'Hide' }}</button>
                        </div>


                        <div class="card-body" style="width: 100%;justify-items: center;padding: 0.55rem;">
                            <div class="card-content d-flex align-items-center flex-column">
                                    {{-- <h5 class="card-title">{{ $title }}</h5> --}}
                                    <h5 class="card-title">{{ $item->item_name }}</h5>
                                    <h3 class="card-value">{{ $item->item_qty }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Hidden Items Modal -->
    <div class="modal fade" id="hiddenItemsModal" tabindex="-1" role="dialog" aria-labelledby="hiddenItemsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hiddenItemsModalLabel">Manage Item Visibility</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="all-items-list" class="list-group"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer_scripts')
    <!--   page level js ----------->
    <script language="javascript" type="text/javascript" src="{{ asset('vendors/chartjs/js/Chart.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>

    <script>
        var CSRF_TOKEN = "{{ csrf_token() }}";
        $(document).ready(function() {
            // Toggle individual item visibility
            $(document).on('click', '.toggle-item-visibility', function() {
                var itemId = $(this).data('item-id');
                var itemCard = $('.item-card[data-item-id="' + itemId + '"]');
                var button = $(this);

                $.ajax({
                    url: '/item/toggle-visibility/' + itemId,
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.is_hidden) {
                                itemCard.hide();
                                button.text('Show');
                            } else {
                                itemCard.show();
                                button.text('Hide');
                            }
                        }
                    }
                });
            });

            // Handle modal show event
            $('#hiddenItemsModal').on('show.bs.modal', function (e) {
                $('#all-items-list').empty(); // Clear previous list
                $.ajax({
                    url: '/item/all-items',
                    type: 'GET',
                    success: function(response) {
                        if (response.length > 0) {
                            response.forEach(function(item) {
                                var isChecked = !item.is_hidden ? 'checked' : '';
                                $('#all-items-list').append(
                                    '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                        item.item_name +
                                        '<input type="checkbox" class="toggle-item-visibility-modal" data-item-id="' + item.id + '" ' + isChecked + '>' +
                                    '</li>'
                                );
                            });
                        } else {
                            $('#all-items-list').append('<li class="list-group-item">No items found.</li>');
                        }
                    }
                });
            });

            // Handle change on checkbox inside the modal
            $(document).on('change', '.toggle-item-visibility-modal', function() {
                var itemId = $(this).data('item-id');
                var mainButton = $('.toggle-item-visibility[data-item-id="' + itemId + '"]');
                // Simulate a click on the main button to trigger the toggle
                mainButton.click();
            });
        });
    </script>
@stop
