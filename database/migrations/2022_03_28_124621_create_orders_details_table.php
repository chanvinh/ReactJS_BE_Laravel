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
        Schema::create('orders_details', function (Blueprint $table) {
            $table->unsignedBigInteger("medicine_id");
            $table->unsignedBigInteger("order_id");
            $table->primary(['medicine_id', 'order_id']);
            $table->foreign('medicine_id')->references("id")->on("medicines");
            $table->foreign("order_id")->references("id")->on("orders");
            $table->integer("amount");
            $table->float("price");
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
        Schema::dropIfExists('orders_details');
    }
};
