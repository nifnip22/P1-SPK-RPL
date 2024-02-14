<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Genre;
use App\Models\UlasanBuku;
use App\Models\KoleksiBuku;
use Illuminate\Support\Str;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $kategoriId = $request->input('kategori_id');
        $genreId = $request->input('genre_id');

        $query = Buku::orderBy('created_at', 'desc');

        if ($keyword) {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('judul_buku', 'like', '%' . $keyword . '%')
                    ->orWhere('no_isbn', 'like', '%' . $keyword . '%')
                    ->orWhere('penulis_buku', 'like', '%' . $keyword . '%')
                    ->orWhere('penerbit_buku', 'like', '%' . $keyword . '%')
                    ->orWhere('tahun_terbit', 'like', '%' . $keyword . '%');
            });
        }

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        if ($genreId) {
            $query->where('genre_id', $genreId);
        }

        $bukus = $query->paginate(20);

        $kategoris = KategoriBuku::orderBy('kategori', 'asc')->get();
        $genres = Genre::orderBy('genre', 'asc')->get();

        return view('lib.buku', [
            'title' => 'Buku | LibraNest',
            'bukus' => $bukus,
            'kategoris' => $kategoris,
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBukuRequest $request)
    {
        // dd($request->all());

        $request->validate([
            'sampul_buku' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'judul_buku' => ['required', 'string', 'max:255'],
            'no_isbn' => ['required', 'numeric', 'integer', 'min:0'],
            'penulis_buku' => ['required', 'string', 'max:255'],
            'penerbit_buku' => ['required', 'string', 'max:255'],
            'tahun_terbit' => ['required', 'numeric', 'integer', 'min:0'],
            'jumlah_halaman' => ['required', 'numeric', 'integer', 'min:0'],
            'kategori_id' => ['required', 'exists:kategori_bukus,id'],
            'genre_id' => ['required', 'exists:genres,id'],
            'deskripsi' => ['nullable', 'string'],
            'bahasa' => ['required', 'string'],
        ]);

        $file = $request->file('sampul_buku');
        $fileName = Str::random(16) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/sampul_buku'), $fileName);

        $buku = Buku::create([
            'sampul_buku' => $fileName,
            'judul_buku' => $request->judul_buku,
            'no_isbn' => $request->no_isbn,
            'penulis_buku' => $request->penulis_buku,
            'penerbit_buku' => $request->penerbit_buku,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_halaman' => $request->jumlah_halaman,
            'kategori_id' => $request->kategori_id,
            'genre_id' => $request->genre_id,
            'deskripsi' => $request->deskripsi,
            'bahasa' => $request->bahasa,
        ]);

        if ($buku) {
            return redirect()->route('buku.index')->with('tambahBuku_success', 'Buku Berhasil di Tambah!');
        } else {
            return redirect()->route('buku.index')->with('tambahBuku_error', 'Terjadi Kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $bukus = Buku::findOrFail($id);
        $kategoris = KategoriBuku::orderBy('kategori', 'asc')->get();
        $genres = Genre::orderBy('genre', 'asc')->get();
        $bookmarkStatus = KoleksiBuku::where('user_id', $user->id)
            ->where('buku_id', $bukus->id)
            ->exists() ? 'bookmarked' : 'unbookmarked';
        $koleksiCount = KoleksiBuku::where('buku_id', $bukus->id)->count();
        $ulasan = UlasanBuku::where('buku_id', $bukus->id)->get();

        $totalRating = 0;
        $totalUlasan = count($ulasan);

        foreach ($ulasan as $review) {
            $totalRating += $review->rating;
        }

        // Menghitung rata-rata rating
        $averageRating = $totalUlasan > 0 ? round($totalRating / $totalUlasan, 2) : 0;

        return view('lib.buku-detail', [
            'title' => 'Buku | LibraNest',
            'bukus' => $bukus,
            'kategoris' => $kategoris,
            'genres' => $genres,
            'bookmarkStatus' => $bookmarkStatus,
            'koleksiCount' => $koleksiCount,
            'ulasan' => $ulasan,
            'averageRating' => $averageRating,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBukuRequest $request, $id)
    {
        $request->validate([
            'judul_buku' => ['required', 'string', 'max:255'],
            'no_isbn' => ['required', 'numeric', 'integer', 'min:0'],
            'penulis_buku' => ['required', 'string', 'max:255'],
            'penerbit_buku' => ['required', 'string', 'max:255'],
            'tahun_terbit' => ['required', 'numeric', 'integer', 'min:0'],
            'jumlah_halaman' => ['required', 'numeric', 'integer', 'min:0'],
            'kategori_id' => ['required', 'exists:kategori_bukus,id'],
            'genre_id' => ['required', 'exists:genres,id'],
            'deskripsi' => ['nullable', 'string'],
            'bahasa' => ['required', 'string'],
        ]);

        $buku = Buku::findOrFail($id);

        $process = $buku->update([
            'judul_buku' => $request->input('judul_buku'),
            'no_isbn' => $request->input('no_isbn'),
            'penulis_buku' => $request->input('penulis_buku'),
            'penerbit_buku' => $request->input('penerbit_buku'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'jumlah_halaman' => $request->input('jumlah_halaman'),
            'kategori_id' => $request->input('kategori_id'),
            'genre_id' => $request->input('genre_id'),
            'deskripsi' => $request->input('deskripsi'),
            'bahasa' => $request->input('bahasa'),
        ]);

        if ($process) {
            return redirect()->route('buku.show', ['buku' => $id])->with('editBuku_success', 'Buku Berhasil di Edit!');
        } else {
            return redirect()->route('buku.show', ['buku' => $id])->with('editBuku_error', 'Terjadi Kesalahan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        $filePath = public_path('assets/sampul_buku/' . $buku->sampul_buku);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        if ($buku->delete()) {
            return redirect()->route('buku.index')->with('deleteBuku_success', 'Buku Berhasil di Hapus!');
        } else {
            return redirect()->route('buku.index')->with('deleteBuku_error', 'Terjadi Kesalahan!');
        }
    }

    public function toggleKoleksi($id)
    {
        $user = auth()->user();
        $buku = Buku::findOrFail($id);

        $existingLike = KoleksiBuku::where('user_id', $user->id)
            ->where('buku_id', $buku->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();

            return response()->json(['status' => 'unbookmarked']);
        } else {
            KoleksiBuku::create([
                'user_id' => $user->id,
                'buku_id' => $buku->id,
            ]);

            return response()->json(['status' => 'bookmarked']);
        }
    }
}
