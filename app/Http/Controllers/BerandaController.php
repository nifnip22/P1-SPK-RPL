<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Genre;
use App\Models\KoleksiBuku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $bukuPalingBanyakDipinjamIds = PeminjamanBuku::select('buku_id', DB::raw('COUNT(*) as total'))
            ->groupBy('buku_id')
            ->orderByDesc('total')
            ->take(8)
            ->pluck('buku_id');

        $bukuPalingBanyakDipinjam = Buku::whereIn('id', $bukuPalingBanyakDipinjamIds)->get();

        $bukus = Buku::orderBy('created_at', 'DESC')->take('8')->get();
        $koleksi = KoleksiBuku::where('user_id', $user->id)->take('8')->get();
        $kategoris = KategoriBuku::orderBy('kategori', 'asc')->get();
        $genres = Genre::orderBy('genre', 'asc')->get();

        return view('lib.beranda', [
            'title' => 'Beranda | LibraNest',
            'bukuPalingBanyakDipinjam' => $bukuPalingBanyakDipinjam,
            'bukus' => $bukus,
            'koleksi' => $koleksi,
            'kategoris' => $kategoris,
            'genres' => $genres,
        ]);
    }
}
