@extends('lib.layouts.main')

@section('main-content')
    <div class="mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 justify-between items-center gap-y-3">
            <h1 class="text-2xl md:text-3xl font-bold">Transaksi</h1>
        </div>
    </div>
    <div class="mt-10">
        <p class="text-gray-500 text-sm mt-2 mb-4">Berikut adalah List Buku yang sedang dalam Masa Peminjaman. Jika Salah
            Satu Buku
            telah Mencapai Tanggal Pengembalian maka Buku Wajib di Kembalikan, jika Tidak di Kembalikan akan dikenakan Denda
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-1">
            @forelse ($peminjamanBuku as $p)
                <a href="{{ route('buku.show', ['buku' => $p->id]) }}"
                    class="flex flex-col items-center overflow-hidden bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl group hover:ring-2 hover:ring-violet-500 duration-300">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-56 md:w-40 md:rounded-none md:rounded-s-lg group-hover:scale-110 duration-300"
                        src="{{ asset('assets/sampul_buku/' . $p->buku->sampul_buku) }}" alt="">
                    <div class="flex flex-col justify-between px-4 py-3 group-hover:px-6 duration-300 leading-normal">
                        <?php
                        $tanggal_pengembalian = \Carbon\Carbon::parse($p->tanggal_pengembalian);
                        $sekarang = \Carbon\Carbon::now();
                        $selisih_hari = $sekarang->diffInDays($tanggal_pengembalian, false);
                        
                        if ($selisih_hari < 3 && $selisih_hari >= 0) {
                            echo '<div class="bg-blue-500 px-2 py-1 w-fit rounded-lg text-gray-100 mb-4 text-sm">';
                            echo 'Mendekati Jatuh Tempo';
                            echo '</div>';
                        } elseif ($selisih_hari === 0) {
                            echo '<div class="bg-orange-500 px-2 py-1 w-fit rounded-lg text-gray-100 mb-4 text-sm">';
                            echo 'Jatuh Tempo';
                            echo '</div>';
                        } elseif ($selisih_hari < 0) {
                            echo '<div class="bg-red-500 px-2 py-1 w-fit rounded-lg text-gray-100 mb-4 text-sm">';
                            echo 'Belum di Kembalikan';
                            echo '</div>';
                        } else {
                            echo '<div class="bg-green-500 px-2 py-1 w-fit rounded-lg text-gray-100 mb-4 text-sm">';
                            echo 'Sedang Peminjaman';
                            echo '</div>';
                        }
                        ?>
                        <p class="mb-1 font-normal text-gray-700">{{ $p->buku->penulis_buku }}</p>
                        <h5 class="mb-4 text-2xl font-semibold tracking-tight text-gray-900">{{ $p->buku->judul_buku }}
                        </h5>
                        <div class="flex items-center mb-3 text-sm">
                            <i class="fa-regular fa-calendar-check mr-2 fa-lg"></i>Tanggal Peminjaman: <span
                                class="text-indigo-500 ml-1">{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center mb-1 text-sm">
                            <i class="fa-regular fa-calendar-xmark mr-2 fa-lg"></i>Tanggal Pengembalian: <span
                                class="text-indigo-500 ml-1">{{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-xl text-violet-300 font-semibold mt-10">Tidak Ada Buku yang Dipinjam.</p>
            @endforelse
        </div>
    </div>
@endsection
