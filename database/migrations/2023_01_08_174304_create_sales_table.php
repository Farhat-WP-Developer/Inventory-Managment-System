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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_man_id');
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->string('route')->nullable();
            $table->integer('stock_out_cost')->default(0);
            $table->integer('stock_out')->default(0);
            $table->integer('stock_in')->default(0);
            $table->integer('sold_stock_qty')->default(0);
            $table->integer('sold_stock_cost')->default(0);
            $table->timestamps();

            $table->foreign('sales_man_id')
                ->references('id')
                ->on('sales_persons');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
