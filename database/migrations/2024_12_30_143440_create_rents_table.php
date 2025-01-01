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
        Schema::create('rents', function (Blueprint $table) {
            $table->unsignedBigInteger("B_user_id");
            $table->unsignedBigInteger("R_flat_id");
            $table->string("R_room_number");
            $table->primary(['B_user_id','R_flat_id','R_room_number']);
            $table->foreign("B_user_id")->references('id')->on('users')->onDelete('cascade');
            $table->foreign("R_flat_id")->references('flat_id')->on('rooms')->onDelete('cascade');
            $table->foreign("R_room_number")->references('room_number')->on('rooms')->onDelete('cascade');
            $table->tinyInteger('rating')->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
