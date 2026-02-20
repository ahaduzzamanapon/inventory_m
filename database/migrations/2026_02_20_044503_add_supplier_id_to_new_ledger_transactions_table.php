<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_ledger_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->nullable()->after('customer_id');
            $table->unsignedBigInteger('sale_id')->nullable()->after('supplier_id');
            $table->unsignedBigInteger('purchase_id')->nullable()->after('sale_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales_models')->onDelete('cascade');
            $table->foreign('purchase_id')->references('id')->on('purchas_models')->onDelete('cascade');
        });

        // Make customer_id nullable using raw SQL to avoid doctrine/dbal dependency
        DB::statement('ALTER TABLE `new_ledger_transactions` MODIFY `customer_id` BIGINT UNSIGNED NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_ledger_transactions', function (Blueprint $table) {
            //
        });
    }
};
