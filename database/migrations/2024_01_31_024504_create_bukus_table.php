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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('sampul_buku');
            $table->string('judul_buku');
            $table->string('no_isbn');
            $table->string('penulis_buku');
            $table->string('penerbit_buku');
            $table->integer('tahun_terbit');
            $table->integer('jumlah_halaman');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('genre_id');
            $table->text('deskripsi')->nullable();
            $table->string('bahasa');
            $table->timestamps();

            $table->foreign('kategori_id')->on('kategori_bukus')->references('id');
            $table->foreign('genre_id')->on('genres')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
