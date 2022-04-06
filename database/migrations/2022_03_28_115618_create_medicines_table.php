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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("category_medicines");
            $table->string("name", 200);
            $table->float("price");
            $table->integer("discount");
            $table->integer("amount");
            $table->text("image");
            $table->string("title", 200);
            $table->string("content", 5000);
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
        Schema::dropIfExists('medicines');
    }
};
