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
        Schema::create('return_sales', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('sale_id'); // References the sales table
            $table->unsignedBigInteger('item_id'); // References the items table
            $table->integer('return_qty'); // Quantity of items returned
            $table->json('return_serial')->nullable(); // JSON field for serial numbers, nullable
            $table->decimal('return_amount', 10, 2); // Amount related to the return
            $table->date('return_date'); // Date of the return
            $table->string('payment_status', 50)->default('Pending'); // Payment status
            $table->timestamps(); // Created_at and Updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_sales');
    }
};
