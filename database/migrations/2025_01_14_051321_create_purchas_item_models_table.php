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
        Schema::create('purchas_item_models', function (Blueprint $table) {
            $table->id();
            $table->integer('purchas_id');
            $table->integer('item_id');
            $table->string('item_name');
            $table->decimal('item_per_price', 10, 2);
            $table->integer('purchas_qty');
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
        Schema::dropIfExists('purchas_item_models');
    }
};
