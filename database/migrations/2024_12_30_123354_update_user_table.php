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
        Schema::table('users', function (Blueprint $table) {
            $table->string('shop_name')->nullable();
            $table->integer('age')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('H_flag')->nullable(); 
            $table->boolean('S_flag')->nullable(); 
            $table->boolean('B_flag')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ShopName');
            $table->dropColumn('Age');
            $table->dropColumn('Occupation');
            $table->dropColumn('H_Flag');
            $table->dropColumn('S_Flag');
            $table->dropColumn('B_Flag');
        });
    }
};
