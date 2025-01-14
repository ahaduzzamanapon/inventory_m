@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Dashboard @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!-- page vendors -->
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">


    <!--end of page vendors -->
@stop
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div aria-label="breadcrumb" class="card-breadcrumb">
            <h1>Dashboard</h1>

        </div>
        <div class="separator-breadcrumb border-top"></div>
    </section>
    <!-- /.content -->
    <section class="content">
        <div class="container-lg col-md-12">
            <div class="row">
                <div class="col-12 col-md-4 col-xxl-3 mb-4 mb-xxl-0">
                    <div class="card bg-body-tertiary border-transparent">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Heading -->
                                    <h4 class="fs-sm fw-normal text-body-secondary mb-1">Item</h4>
                                    <?php
                                    $item_count = DB::table('items')->count();
                                    ?>
                                    <!-- Text -->
                                    <div class="fs-4 fw-semibold">{{ $item_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg bg-body text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" class="fs-4 duo-icon duo-icon-credit-card"
                                            data-duoicon="credit-card">
                                            <path fill="currentColor" d="M22 10v7a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-7h20Z"
                                                class="duoicon-secondary-layer" opacity=".3"></path>
                                            <path fill="currentColor"
                                                d="M19 4a3 3 0 0 1 3 3v1H2V7a3 3 0 0 1 3-3h14Zm-1 10h-3a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2Z"
                                                class="duoicon-primary-layer"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-xxl-3 mb-4 mb-xxl-0">
                    <div class="card bg-body-tertiary border-transparent">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Heading -->
                                    <h4 class="fs-sm fw-normal text-body-secondary mb-1">Category</h4>
                                    <?php
                                    $category_count = DB::table('categorys')->count();
                                    ?>
                                    <!-- Text -->
                                    <div class="fs-4 fw-semibold">{{ $category_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg bg-body text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" class="fs-4 duo-icon duo-icon-clock" data-duoicon="clock">
                                            <path fill="currentColor"
                                                d="M12 4c6.928 0 11.258 7.5 7.794 13.5A8.998 8.998 0 0 1 12 22C5.072 22 .742 14.5 4.206 8.5A8.998 8.998 0 0 1 12 4Z"
                                                class="duoicon-secondary-layer" opacity=".3"></path>
                                            <path fill="currentColor"
                                                d="M7.366 2.971A1 1 0 0 1 7 4.337a10.063 10.063 0 0 0-2.729 2.316 1 1 0 1 1-1.544-1.27 12.046 12.046 0 0 1 3.271-2.777 1 1 0 0 1 1.367.365h.001ZM18 2.606a12.044 12.044 0 0 1 3.272 2.776 1 1 0 0 1-1.544 1.27 10.042 10.042 0 0 0-2.729-2.315 1 1 0 0 1 1.002-1.731H18ZM12 8a1 1 0 0 0-.993.883L11 9v3.986c-.003.222.068.44.202.617l.09.104 2.106 2.105a1 1 0 0 0 1.498-1.32l-.084-.094L13 12.586V9a1 1 0 0 0-1-1Z"
                                                class="duoicon-primary-layer"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-xxl-3 mb-4 mb-md-0">
                    <div class="card bg-body-tertiary border-transparent">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Heading -->
                                    <h4 class="fs-sm fw-normal text-body-secondary mb-1">Sub Category</h4>
                                    <?php
                                    $subcategory_count = DB::table('subcategorys')->count();
                                    ?>

                                    <!-- Text -->
                                    <div class="fs-4 fw-semibold">{{ $subcategory_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg bg-body text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" class="fs-4 duo-icon duo-icon-slideshow"
                                            data-duoicon="slideshow">
                                            <path fill="currentColor"
                                                d="M21 3a1 1 0 1 1 0 2v11a2 2 0 0 1-2 2h-5.055l2.293 2.293a1 1 0 0 1-1.414 1.414l-2.829-2.828-2.828 2.828a1 1 0 0 1-1.414-1.414L10.046 18H5a2 2 0 0 1-2-2V5a1 1 0 1 1 0-2h18Z"
                                                class="duoicon-secondary-layer" opacity=".3"></path>
                                            <path fill="currentColor"
                                                d="M8 11a1 1 0 0 0-1 1v1a1 1 0 1 0 2 0v-1a1 1 0 0 0-1-1Zm4-2a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0v-3a1 1 0 0 0-1-1Zm4-2a1 1 0 0 0-.993.883L15 8v5a1 1 0 0 0 1.993.117L17 13V8a1 1 0 0 0-1-1Z"
                                                class="duoicon-primary-layer"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-xxl-3">
                    <div class="card bg-body-tertiary border-transparent">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Heading -->
                                    <h4 class="fs-sm fw-normal text-body-secondary mb-1">Customer</h4>
                                    <?php
                                    $customer_count = DB::table('customers')->count();
                                    ?>

                                    <!-- Text -->
                                    <div class="fs-4 fw-semibold">{{ $customer_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg bg-body text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" class="fs-4 duo-icon duo-icon-discount"
                                            data-duoicon="discount">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M9.405 2.897a4 4 0 0 1 5.02-.136l.17.136.376.32c.274.234.605.389.96.45l.178.022.493.04a4 4 0 0 1 3.648 3.468l.021.2.04.494c.028.358.153.702.36.996l.11.142.322.376a4 4 0 0 1 .136 5.02l-.136.17-.321.376a1.997 1.997 0 0 0-.45.96l-.022.178-.039.493a4 4 0 0 1-3.468 3.648l-.201.021-.493.04a2.002 2.002 0 0 0-.996.36l-.142.111-.377.32a4 4 0 0 1-5.02.137l-.169-.136-.376-.321a1.997 1.997 0 0 0-.96-.45l-.178-.021-.493-.04a4 4 0 0 1-3.648-3.468l-.021-.2-.04-.494a2.002 2.002 0 0 0-.36-.996l-.111-.142-.321-.377a4 4 0 0 1-.136-5.02l.136-.169.32-.376c.234-.274.389-.605.45-.96l.022-.178.04-.493A4 4 0 0 1 7.197 3.75l.2-.021.494-.04c.358-.028.702-.153.996-.36l.142-.111.376-.32v-.001Z"
                                                class="duoicon-secondary-layer" opacity=".3"></path>
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M9.5 8a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Zm4.793.293-6 6a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0-1.414-1.414ZM14.5 13a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z"
                                                class="duoicon-primary-layer"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-xxl-3">
                    <div class="card bg-body-tertiary border-transparent">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Heading -->
                                    <h4 class="fs-sm fw-normal text-body-secondary mb-1">Total Sale</h4>
                                    <?php
                                    $customer_count = DB::table('customers')->count();
                                    ?>

                                    <!-- Text -->
                                    <div class="fs-4 fw-semibold">{{ $customer_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg bg-body text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" class="fs-4 duo-icon duo-icon-discount"
                                            data-duoicon="discount">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M9.405 2.897a4 4 0 0 1 5.02-.136l.17.136.376.32c.274.234.605.389.96.45l.178.022.493.04a4 4 0 0 1 3.648 3.468l.021.2.04.494c.028.358.153.702.36.996l.11.142.322.376a4 4 0 0 1 .136 5.02l-.136.17-.321.376a1.997 1.997 0 0 0-.45.96l-.022.178-.039.493a4 4 0 0 1-3.468 3.648l-.201.021-.493.04a2.002 2.002 0 0 0-.996.36l-.142.111-.377.32a4 4 0 0 1-5.02.137l-.169-.136-.376-.321a1.997 1.997 0 0 0-.96-.45l-.178-.021-.493-.04a4 4 0 0 1-3.648-3.468l-.021-.2-.04-.494a2.002 2.002 0 0 0-.36-.996l-.111-.142-.321-.377a4 4 0 0 1-.136-5.02l.136-.169.32-.376c.234-.274.389-.605.45-.96l.022-.178.04-.493A4 4 0 0 1 7.197 3.75l.2-.021.494-.04c.358-.028.702-.153.996-.36l.142-.111.376-.32v-.001Z"
                                                class="duoicon-secondary-layer" opacity=".3"></path>
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M9.5 8a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Zm4.793.293-6 6a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0-1.414-1.414ZM14.5 13a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z"
                                                class="duoicon-primary-layer"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-xxl-3">
                    <div class="card bg-body-tertiary border-transparent">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Heading -->
                                    <h4 class="fs-sm fw-normal text-body-secondary mb-1">Total Purchase</h4>
                                    <?php
                                    $customer_count = DB::table('customers')->count();
                                    ?>

                                    <!-- Text -->
                                    <div class="fs-4 fw-semibold">{{ $customer_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg bg-body text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" class="fs-4 duo-icon duo-icon-discount"
                                            data-duoicon="discount">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M9.405 2.897a4 4 0 0 1 5.02-.136l.17.136.376.32c.274.234.605.389.96.45l.178.022.493.04a4 4 0 0 1 3.648 3.468l.021.2.04.494c.028.358.153.702.36.996l.11.142.322.376a4 4 0 0 1 .136 5.02l-.136.17-.321.376a1.997 1.997 0 0 0-.45.96l-.022.178-.039.493a4 4 0 0 1-3.468 3.648l-.201.021-.493.04a2.002 2.002 0 0 0-.996.36l-.142.111-.377.32a4 4 0 0 1-5.02.137l-.169-.136-.376-.321a1.997 1.997 0 0 0-.96-.45l-.178-.021-.493-.04a4 4 0 0 1-3.648-3.468l-.021-.2-.04-.494a2.002 2.002 0 0 0-.36-.996l-.111-.142-.321-.377a4 4 0 0 1-.136-5.02l.136-.169.32-.376c.234-.274.389-.605.45-.96l.022-.178.04-.493A4 4 0 0 1 7.197 3.75l.2-.021.494-.04c.358-.028.702-.153.996-.36l.142-.111.376-.32v-.001Z"
                                                class="duoicon-secondary-layer" opacity=".3"></path>
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M9.5 8a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Zm4.793.293-6 6a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0-1.414-1.414ZM14.5 13a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z"
                                                class="duoicon-primary-layer"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card col-md-12">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="fs-6 mb-0">Customers</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <?php
                        $customers = DB::table('customers')->get();
                        ?>
                        <table class="table table-flush align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="fs-sm">Name</th>
                                    <th class="fs-sm">Email</th>
                                    <th class="fs-sm">Phone number</th>
                                    <th class="fs-sm">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-4">
                                                <div>{{ $customer->customer_name }}</div>
                                                <div class="fs-sm text-body-secondary">Added on {{ \Carbon\Carbon::parse($customer->created_at)->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $customer->customer_email }}</td>
                                    <td>{{ $customer->customer_phone }}</td>
                                    <td>{{ $customer->customer_address }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

@stop
@section('footer_scripts')
    <!--   page level js ----------->
    <script language="javascript" type="text/javascript" src="{{ asset('vendors/chartjs/js/Chart.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>

    <!-- end of page level js -->
@stop
