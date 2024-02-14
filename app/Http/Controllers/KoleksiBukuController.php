<?php

namespace App\Http\Controllers;

use App\Models\KoleksiBuku;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKoleksiBukuRequest;
use App\Http\Requests\UpdateKoleksiBukuRequest;

class KoleksiBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $koleksi = KoleksiBuku::where('user_id', $user->id)->with('buku')->get();

        // Mendapatkan semua foto yang difavoritkan oleh pengguna
        $koleksiBuku = $koleksi->pluck('buku')->flatten();

        return view('lib.koleksi', [
            'title' => 'Koleksi | LibraNest',
            'koleksiBuku' => $koleksiBuku,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKoleksiBukuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KoleksiBuku $koleksiBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KoleksiBuku $koleksiBuku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKoleksiBukuRequest $request, KoleksiBuku $koleksiBuku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KoleksiBuku $koleksiBuku)
    {
        //
    }
}
