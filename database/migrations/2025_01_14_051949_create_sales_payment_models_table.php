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
        Schema::create('sales_payment_models', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->unique();
            $table->integer('customer_id');
            $table->date('payment_date');
            $table->foreignId('sale_id')->constrained('sales_models')->onDelete('cascade');
            $table->integer('payment_method');
            $table->decimal('payment_amount', 10, 2);
            $table->enum('payment_status', ['Pending', 'Completed', 'Failed'])->default('Pending');
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
        Schema::dropIfExists('sales_payment_models');
    }
};
