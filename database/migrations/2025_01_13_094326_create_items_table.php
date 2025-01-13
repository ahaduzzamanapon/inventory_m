<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_id');
            $table->string('item_name');
            $table->integer('item_category');
            $table->integer('item_sub_category');
            $table->string('item_model');
            $table->integer('item_qty');
            $table->integer('item_unit');
            $table->float('item_purchase_price');
            $table->float('item_sale_price');
            $table->integer('item_company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
