<?php

Route::get('new_sales', 'SalesController@newSales')->name('sales.new_sales');
Route::get('sales_list', 'SalesController@salesList')->name('sales.sales_list');
Route::get('sales/delete/{id}', 'SalesController@delete')->name('sales.delete');
Route::get('sales/make_payment/{id}', 'SalesController@make_payment')->name('sales.make_payment');
Route::get('sales/invoice/{id}', 'SalesController@invoice')->name('sales.invoice');
Route::resource('sales', 'SalesController');
Route::post('sales/payment/store', 'SalesController@make_payment_store')->name('sales.payment.store');


