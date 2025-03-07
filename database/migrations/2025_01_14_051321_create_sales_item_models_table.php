<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_item_models', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id');
            $table->integer('item_id');
            $table->string('item_serial');
            $table->string('item_name');
            $table->decimal('item_per_price', 10, 2);
            $table->integer('sales_qty');
            $table->decimal('total_price', 10, 2);
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
        Schema::dropIfExists('sales_item_models');
    }
};
