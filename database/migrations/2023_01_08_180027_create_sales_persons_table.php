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
        Schema::create('sales_persons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            // $table->string('position');
            $table->date('hire_date')->format('dd-mm-yyyy')->nullable();
            $table->integer('basic_salary')->default(0);
            $table->integer('commission_rate')->default(0);
            $table->integer('loan')->default(0);
            $table->integer('total_salary')->default(0);
            // $table->decimal('incentives', 8, 2)->default(0);
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
        Schema::dropIfExists('sales_persons');
    }
};
