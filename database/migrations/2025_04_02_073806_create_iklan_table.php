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
        Schema::create('iklan', function (Blueprint $table) {
            $table->bigIncrements('id_iklan');
            $table->unsignedBigInteger('id_client'); 
            $table->string('nama_iklan');
            $table->integer('jumlah_putar');
            $table->date('periode_siar_mulai');
            $table->date('periode_siar_selesai');
            $table->timestamps();

            // fk ke tabel client
            $table->foreign('id_client')->references('id_client')->on('client')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iklan');
    }
};