<?php

Route::get('new_sales', 'SalesController@newSales')->name('sales.new_sales');
Route::get('sales_return_payment/{id}', 'SalesController@sales_return_payment');
Route::get('sales_return', 'SalesController@sales_return')->name('sales.sales_return');
Route::get('sales_list', 'SalesController@salesList')->name('sales.sales_list');
Route::get('sales/delete/{id}', 'SalesController@delete')->name('sales.delete');
Route::get('sales/make_payment/{id}', 'SalesController@make_payment')->name('sales.make_payment');
Route::get('sales/invoice/{id}', 'SalesController@invoice')->name('sales.invoice');
Route::resource('sales', 'SalesController');
Route::post('sales/payment/store', 'SalesController@make_payment_store')->name('sales.payment.store');
Route::post('get_return_sale_data', 'SalesController@get_return_sale_data')->name('sales.get_return_sale_data');
Route::post('return_store', 'SalesController@return_store')->name('sales.return_store');


