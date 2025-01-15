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
        Schema::create('purchas_models', function (Blueprint $table) {
            $table->id();
            $table->string('purchas_id')->unique();
            $table->integer('supplier_id');
            $table->date('purchas_date');
            $table->string('reference_no')->nullable();
            $table->decimal('sub_total', 10, 2);
            $table->enum('discount_status',['Fixed', 'Percentage'])->default('Fixed');
            $table->decimal('discount_per', 5, 2)->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->enum('tax_status',['Fixed', 'Percentage'])->default('Fixed');
            $table->decimal('tax_per', 5, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('other_charges', 10, 2)->default(0.00);
            $table->decimal('grand_total', 10, 2);
            $table->enum('payment_status', ['Pending', 'Paid', 'Partial'])->default('Pending');
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
        Schema::dropIfExists('purchas_models');
    }
};
