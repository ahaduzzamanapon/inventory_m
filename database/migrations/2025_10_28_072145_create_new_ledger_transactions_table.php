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
        Schema::create('new_ledger_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->date('date');
            $table->string('transaction_type');
            $table->text('description')->nullable();
            $table->decimal('bill_amount', 15, 2)->nullable();
            $table->decimal('paid_amount', 15, 2)->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->decimal('returned_amount', 15, 2)->nullable();
            $table->decimal('balance', 15, 2);
            $table->string('payment_method')->nullable();
            $table->string('invoice_no')->nullable();
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
        Schema::dropIfExists('new_ledger_transactions');
    }
};
