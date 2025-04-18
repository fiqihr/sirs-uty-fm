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
        Schema::create('pivot_memo', function (Blueprint $table) {
            $table->bigIncrements('id_pivot_memo');
            $table->unsignedBigInteger('id_memo');
            $table->unsignedBigInteger('id_rs');
            $table->timestamps();

            $table->foreign('id_memo')->references('id_memo')->on('memo')->onDelete('cascade');
            $table->foreign('id_rs')->references('id_rs')->on('rancangan_siar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_memo');
    }
};