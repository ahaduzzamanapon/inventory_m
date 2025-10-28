<?php


Route::get('purchas', 'PurchasController@index')->name('purchas.index');
Route::get('new_purchas', 'PurchasController@newPurchas')->name('purchas.new_purchas');
Route::post('purchas', 'PurchasController@store')->name('purchas.store');
Route::get('purchas_list', 'PurchasController@purchasList')->name('purchas.purchas_list');
Route::get('purchas/{id}', 'PurchasController@show')->name('purchas.show');
Route::get('purchas/delete/{id}', 'PurchasController@delete')->name('purchas.delete');
Route::get('purchas/make_payment/{id}', 'PurchasController@make_payment')->name('purchas.make_payment');
Route::post('purchas/make_payment', 'PurchasController@make_payment_store')->name('purchas.payment.store');
Route::get('purchas/invoice/{id}', 'PurchasController@invoice')->name('purchas.invoice');
Route::get('purchas/edit/{id}', 'PurchasController@edit')->name('purchas.edit');
Route::patch('purchas/{id}', 'PurchasController@update')->name('purchas.update');
Route::get('approve_payment_p/{id}', 'PurchasController@approve_payment_p')->name('purchas.approve_payment_p');
Route::get('purchas_return', 'PurchasController@purchas_return')->name('purchas.purchas_return');
Route::post('get_return_purchas_data', 'PurchasController@get_return_purchas_data')->name('purchas.get_return_purchas_data');
Route::post('return_store_p', 'PurchasController@return_store_p')->name('purchas.return_store_p');
Route::get('purchas_return_payment/{id}', 'PurchasController@purchas_return_payment')->name('purchas.purchas_return_payment');


