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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('emp_id');
            $table->string('month');
            $table->decimal('salary', 10, 2);
            $table->decimal('total_present', 10, 2);
            $table->decimal('total_absent', 10, 2);
            $table->decimal('ba_deduct_day', 10, 2);
            $table->decimal('total_salary', 10, 2);
            $table->decimal('ba_deduct', 10, 2);
            $table->decimal('absent_deduct', 10, 2);
            $table->decimal('bonus_amount', 10, 2);
            $table->decimal('gross_salary', 10, 2);
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
        Schema::dropIfExists('salaries');
    }
};
