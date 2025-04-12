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
        Schema::create('rancangan_siar', function (Blueprint $table) {
            $table->bigIncrements('id_rs');
            $table->unsignedBigInteger('id_iklan');
            $table->unsignedBigInteger('id_tgl_rs');
            $table->string('jam');
            $table->integer('kuadran');
            $table->dateTime('menit_putar')->nullable();
            $table->timestamps();

            // fk ke tabel jam dan iklan
            $table->foreign('id_tgl_rs')->references('id_tgl_rs')->on('tanggal_rs')->onDelete('cascade');
            $table->foreign('id_iklan')->references('id_iklan')->on('iklan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penayangan');
    }
};