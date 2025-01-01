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
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('room_number');
            $table->unsignedBigInteger('flat_id');
            $table->integer('rent');
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'rented'])->default('available');
            $table->primary(['room_number', 'flat_id']);
            $table->foreign('flat_id')->references('flat_id')->on('flats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
