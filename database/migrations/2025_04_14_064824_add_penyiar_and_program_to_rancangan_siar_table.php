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
        Schema::table('rancangan_siar', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->after('id_tgl_rs')->nullable();
            $table->unsignedBigInteger('id_program')->after('id_user')->nullable();

            // Foreign key constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_program')->references('id_program')->on('program')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rancangan_siar', function (Blueprint $table) {
            //
        });
    }
};