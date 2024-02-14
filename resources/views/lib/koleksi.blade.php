@extends('lib.layouts.main')

@section('main-content')
    <div class="mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 justify-between items-center gap-y-3">
            <h1 class="text-2xl md:text-3xl font-bold">Koleksi</h1>
        </div>
    </div>
    <div class="mt-10">
        <p class="text-gray-500 text-sm mt-2 mb-4">Anda Dapat Mengkoleksi Buku yang akan Anda Pinjam atau Sudah Pernah Anda
            Baca
        </p>
        <div class="flex flex-wrap justify-center xl:justify-start items-center gap-x-3 gap-y-6">
            @forelse ($koleksiBuku as $buku)
                <a href="{{ route('buku.show', ['buku' => $buku->id]) }}" class="book flex flex-col group w-40">
                    <div class="grid grid-cols-2 items-center text-xs text-center text-gray-100">
                        <div class="bg-violet-500 px-3 py-1 rounded-tl-lg">{{ $buku->kategori->kategori }}</div>
                        <div class="bg-gray-900 px-3 py-1 rounded-tr-lg">{{ $buku->genre->genre }}</div>
                    </div>
                    <div class="image-cover overflow-hidden h-56 bg-white duration-300 rounded-b-lg">
                        <img src="{{ asset('assets/sampul_buku/' . $buku->sampul_buku) }}"
                            class="object- w-full h-full group-hover:scale-110 duration-300 transition-transform ease-in-out">
                    </div>
                    <div class="detail text-center mt-2">
                        <h1 class="text-md md:text-lg font-semibold group-hover:text-violet-500 duration-300">
                            {{ $buku->judul_buku }}</h1>
                        <p class="text-sm md:text-md font-medium group-hover:text-violet-500 duration-300 truncate">
                            {{ $buku->penulis_buku }}</p>
                    </div>
                </a>
            @empty
                <p class="text-center text-xl text-violet-300 font-semibold mt-10">Tidak Ada Buku yang Dikoleksi.</p>
            @endforelse
        </div>
    </div>
@endsection
