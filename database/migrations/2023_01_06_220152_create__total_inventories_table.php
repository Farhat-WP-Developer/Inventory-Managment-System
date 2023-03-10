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
        Schema::create('total_inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('pro_code')->unique()->default(0);
            $table->string('pro_name')->nullable();
            $table->integer('total_qty')->nullable();
            $table->integer('per_price')->nullable();
            $table->integer('total_cost')->default(0);
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
        Schema::dropIfExists('total_inventories');
    }
};
