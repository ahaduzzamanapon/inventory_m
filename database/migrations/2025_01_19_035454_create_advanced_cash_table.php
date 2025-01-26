<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvancedCashTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advanced_cash', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('purpose');
            $table->integer('amount');
            $table->string('status');
            $table->string('settled_amount')->nullable();
            $table->string('settled_status')->default('Pending')->nullable();

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
        Schema::drop('advanced_cash');
    }
}
