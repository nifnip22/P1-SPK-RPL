<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
use App\Http\Requests\StorePeminjamanBukuRequest;
use App\Http\Requests\UpdatePeminjamanBukuRequest;

class PeminjamanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamanBuku = PeminjamanBuku::where('user_id', auth()->user()->id)->get();

        return view('lib.transaksi', [
            'title' => 'Transaksi | LibraNest',
            'peminjamanBuku' => $peminjamanBuku,
        ]);
    }

    public function indexPetugas(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = PeminjamanBuku::orderBy('tanggal_pengembalian', 'ASC');

        if ($keyword) {
            $query->whereHas('user', function ($subQuery) use ($keyword) {
                $subQuery->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('nama_lengkap', 'like', '%' . $keyword . '%');
            });
        }

        $peminjamanBuku = $query->paginate(20);

        return view('lib.peminjaman', [
            'title' => 'Data Peminjaman | LibraNest',
            'peminjamanBuku' => $peminjamanBuku,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeminjamanBukuRequest $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
        ]);

        PeminjamanBuku::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        return redirect()->route('transaksi.index')->with('peminjaman_success', 'Peminjaman Buku Berhasil!');
    }

    public function destroy($id)
    {
        $peminjaman = PeminjamanBuku::findOrFail($id);

        if ($peminjaman->delete()) {
            return redirect()->route('transaksi.indexPetugas')->with('deletePeminjaman_success', 'Peminjaman Berhasil di Hapus!');
        } else {
            return redirect()->route('transaksi.indexPetugas')->with('deletePeminjaman_error', 'Terjadi Kesalahan!');
        }
    }
}
