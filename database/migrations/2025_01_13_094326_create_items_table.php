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
            $table->string('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('item_image')->nullable();
            $table->integer('item_category')->nullable();
            $table->integer('item_sub_category')->nullable();
            $table->string('item_model')->nullable();
            $table->integer('item_qty')->nullable();
            $table->integer('item_unit')->nullable();
            $table->float('item_purchase_price')->nullable();
            $table->float('item_sale_price')->nullable();
            $table->integer('item_company_id')->nullable();
            $table->integer('item_brand_id')->nullable();
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
