@extends('lib.layouts.main')

@section('main-content')
    <div class="mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 justify-between items-center gap-y-3">
            <h1 class="text-2xl md:text-3xl font-bold">Data Peminjaman</h1>
            <form action="{{ route('transaksi.indexPetugas') }}" method="GET">
                @csrf
                <div class="flex">
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" name="keyword"
                            class="block p-2.5 w-full z-20 text-sm bg-gray-50 rounded-lg border border-gray-300 focus:ring-violet-500 focus:border-violet-500 text-violet-500"
                            placeholder="Cari Berdasarkan Username atau Nama Lengkap Peminjam"
                            value="{{ request('keyword') }}">
                        <button type="submit"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-fuchsia-700 rounded-e-lg border border-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:outline-none focus:ring-fuchsia-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-10">
        <p class="text-gray-500 text-sm mt-2 mb-4">Petugas Dapat Melihat Data dari Buku yang di Pinjam dari Peminjam
        </p>
        <div class="bg-white rounded-lg p-4 drop-shadow-md">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Peminjam
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Buku yang di Pinjam
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Peminjaman
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Pengembalian
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <i class="fa fa-cog fa-lg"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamanBuku as $p)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                    {{ $p->user->nama_lengkap }} ({{ $p->user->name }})
                                </td>
                                <td class="px-6 py-4">
                                    {{ $p->buku->judul_buku }} ({{ $p->buku->penulis_buku }})
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php
                                    $tanggal_pengembalian = \Carbon\Carbon::parse($p->tanggal_pengembalian);
                                    $sekarang = \Carbon\Carbon::now();
                                    $selisih_hari = $sekarang->diffInDays($tanggal_pengembalian, false);
                                    
                                    switch (true) {
                                        case $selisih_hari < 3 && $selisih_hari >= 0:
                                            echo '<span class="text-blue-500">Mendekati Jatuh Tempo</span>';
                                            break;
                                        case $selisih_hari === 0:
                                            echo '<span class="text-orange-500">Jatuh Tempo</span>';
                                            break;
                                        case $selisih_hari < 0:
                                            echo '<span class="text-red-500">Belum di Kembalikan</span>';
                                            break;
                                        default:
                                            echo '<span class="text-green-500">Sedang Peminjaman</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('peminjaman.destroy', ['peminjaman' => $p->id]) }}"
                                        method="POST" id="deletePeminjaman-form-{{ $p->id }}"
                                        data-id="{{ $p->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="deletePeminjaman-button bg-blue-500 hover:bg-blue-700 duration-300 p-3 rounded-lg text-gray-100"><i
                                                class="fa fa-check"></i> Dikembalikan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
