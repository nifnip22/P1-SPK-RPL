<?php

namespace App\Http\Controllers;

use App\Models\UlasanBuku;
use App\Http\Requests\StoreUlasanBukuRequest;
use App\Http\Requests\UpdateUlasanBukuRequest;

class UlasanBukuController extends Controller
{
    public function store(StoreUlasanBukuRequest $request)
    {
        $validatedData = $request->validated();
        $ulasan = UlasanBuku::create($validatedData);

        $ulasan->load('user', 'buku');

        return redirect()->back()->with('ulasan', $ulasan);
    }
}
