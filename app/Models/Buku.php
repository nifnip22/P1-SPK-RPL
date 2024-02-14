<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'sampul_buku',
        'judul_buku',
        'no_isbn',
        'penulis_buku',
        'penerbit_buku',
        'tahun_terbit',
        'jumlah_halaman',
        'kategori_id',
        'genre_id',
        'deskripsi',
        'bahasa',
    ];

    public function kategori() {
        return $this->belongsTo(KategoriBuku::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function peminjaman () {
        return $this->hasMany(PeminjamanBuku::class);
    }

    public function koleksi () {
        return $this->hasMany(KoleksiBuku::class);
    }

    public function ulasan () {
        return $this->hasMany(UlasanBuku::class);
    }
}
