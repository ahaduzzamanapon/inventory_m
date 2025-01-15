<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogisticBillsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistic_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('Sale');
            $table->integer('location');
            $table->integer('customer');
            $table->string('amount');
            $table->text('attachment');
            $table->text('note');
            $table->string('status');
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
        Schema::drop('logistic_bills');
    }
}
