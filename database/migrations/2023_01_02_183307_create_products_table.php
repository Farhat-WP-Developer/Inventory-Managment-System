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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('trk_number');
            $table->foreign('trk_number')->references('trk_number')->on('trucks');
            $table->string('pro_id')->nullable();
            $table->string('name');
            $table->integer('in')->default(0);
            $table->integer('out')->default(0);
            $table->integer('on_hand')->default(0);
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
        Schema::dropIfExists('products');
    }
};
