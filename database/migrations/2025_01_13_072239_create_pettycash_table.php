<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePettycashTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pettycash', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('account_ledgers');
            $table->string('account_description');
            $table->float('amount');
            $table->text('attachment')->nullable();
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
        Schema::drop('pettycash');
    }
}
