<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();

            $table->unsignedBigInteger('rating');
            $table->text('content');

            $table->unsignedBigInteger('orderable_id')->index();
            $table->foreign('orderable_id')->references('id')->on('orderables');

            $table->unsignedBigInteger('order_id')->index()->nullable();
            $table->foreign('order_id')->references('id')->on('orderables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
