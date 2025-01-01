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
        Schema::create('subscribed_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('B_user_id');
            $table->foreign('B_user_id')->references('id')->on('users')->onDelete("cascade");
            $table->unsignedBigInteger('M_shop_id');
            $table->foreign('M_shop_id')->references('shop_id')->on('meal_subscriptions')->onDelete("cascade");
            $table->unsignedBigInteger('M_plan_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribed_infos');
    }
};
