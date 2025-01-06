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
        Schema::create('food__orders', function (Blueprint $table) {
            $table->id();
            $table->integer("delivery_cost");
            $table->smallInteger("rating")->nullable();
            $table->string('status')->nullable();
            $table->date('order_date');
            $table->unsignedBigInteger('B_user_id');
            $table->foreign("B_user_id")->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food__orders');
    }
};
