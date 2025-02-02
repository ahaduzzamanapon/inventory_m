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
        Schema::create('sales_models', function (Blueprint $table) {
            $table->id();
            $table->string('sales_id')->unique();
            $table->integer('customer_id');
            $table->date('sale_date');
            $table->string('reference_no')->nullable();
            $table->decimal('sub_total', 10, 2);
            $table->string('discount_status')->default('Fixed');
            $table->decimal('discount_per', 5, 2)->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->string('tax_status')->default('Fixed');
            $table->decimal('tax_per', 5, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('other_charges', 10, 2)->default(0.00);
            $table->decimal('grand_total', 10, 2);
            $table->string('payment_status')->default('Pending');
            $table->decimal('payment_amount', 10, 2)->default(0.00);
            $table->decimal('due_amount', 10, 2)->default(0.00);
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
        Schema::dropIfExists('sales_models');
    }
};
