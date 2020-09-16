<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('adults');
            $table->integer('children')->nullable();
            $table->unsignedInteger('city_from_id');
            $table->foreign('city_from_id', 'city_from_fk_1587040')->references('id')->on('cities');
            $table->unsignedInteger('city_to_id');
            $table->foreign('city_to_id', 'city_to_fk_1587042')->references('id')->on('cities');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
