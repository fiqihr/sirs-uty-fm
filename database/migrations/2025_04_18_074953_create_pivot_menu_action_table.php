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
        Schema::create('pivot_menu_action', function (Blueprint $table) {
            $table->bigIncrements('id_pivot_menu_action');
            $table->unsignedBigInteger('id_menu_action');
            $table->unsignedBigInteger('id_rs');
            $table->timestamps();

            $table->foreign('id_menu_action')->references('id_menu_action')->on('menu_action')->onDelete('cascade');
            $table->foreign('id_rs')->references('id_rs')->on('rancangan_siar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_menu_action');
    }
};