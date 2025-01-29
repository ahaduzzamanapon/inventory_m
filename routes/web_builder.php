<?php



Route::resource('categories', 'CategoryController');

Route::resource('subCategories', 'SubCategoryController');

Route::resource('brands', 'BrandController');

Route::resource('units', 'UnitController');
Route::resource('siteSettings', 'SiteSettingController');


Route::resource('customers', 'CustomerController');

Route::resource('suppliers', 'SupplierController');

Route::resource('paymentMethods', 'PaymentMethodController');

Route::resource('accountLedgers', 'AccountLedgerController');

Route::resource('locations', 'LocationController');

Route::resource('pettyCashes', 'PettyCashController');

Route::resource('items', 'ItemController');


Route::resource('companies', 'CompanieController');




Route::resource('logisticBills', 'LogisticBillController');
Route::resource('users', 'UserController');


Route::resource('attendences', 'AttendenceController');

Route::resource('advancedCashes', 'AdvancedCashController');

Route::resource('termAndConditions', 'TermAndConditionController');

Route::resource('permissions', 'PermissionController');

Route::resource('roleAndPermissions', 'RoleAndPermissionController');


Route::resource('bonuses', 'BonusController');

Route::resource('designations', 'DesignationController');