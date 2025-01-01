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
        Schema::create('bid_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('bid_id');
            $table->foreign('bid_id')->references('id')->on('bids')->onDelete("cascade");
            $table->unsignedBigInteger('flat_id');
            $table->foreign('flat_id')->references('flat_id')->on('flats')->onDelete("cascade");
            $table->unsignedBigInteger('H_user_id');
            $table->foreign('H_user_id')->references('owner_id')->on('flats')->onDelete("cascade");
            $table->unsignedBigInteger('B_user_id');
            $table->foreign('B_user_id')->references('id')->on('users')->onDelete("cascade");
            $table->primary(["flat_id", 'bid_id', 'H_user_id', 'B_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_infos');
    }
};
