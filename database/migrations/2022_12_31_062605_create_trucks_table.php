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
        Schema::create('trucks', function (Blueprint $table) {
            // $table->increments('serial_number');
            $table->id();
            $table->string('trk_number')->unique();
            $table->string('driver_name')->nullable();
            $table->string('trk_name')->nullable();
            // $table->string('catgories')->nullable();
            // $table->integer('cat_qty')->nullable()->default(0);
            // $table->integer('total_qty')->nullable()->default(0);
            $table->integer('pilots')->nullable()->default(0);
            $table->integer('shells')->nullable()->default(0);
            $table->integer('empty')->nullable()->default(0);
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
        Schema::dropIfExists('trucks');
    }
};


