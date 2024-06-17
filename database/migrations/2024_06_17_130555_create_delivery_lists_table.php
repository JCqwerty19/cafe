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
        Schema::create('delivery_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('courier_id');
            $table->unsignedBigInteger('order_id');
            $table->softDeletes();
            $table->timestamps();

            //$table->foreign('courier_id')->references('id')->on('couriers')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_lists');
    }
};
