<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('belongs_tos', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('shop_id')->on('menus')->onDelete("cascade");
            $table->string("item_name");
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('food__orders')->onDelete("cascade");
            $table->primary(["shop_id", 'item_name', 'order_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belongs_tos');
    }
};
