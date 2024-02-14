@extends('lib.layouts.main')

@section('main-content')
    <div class="mt-4">
        <h1 class="text-2xl md:text-3xl font-bold">Paling Banyak di Pinjam</h1>
        <div class="pinjamSlider relative">
            <div class="pinjam-carousel flex items-center gap-x-4">
                @forelse ($bukuPalingBanyakDipinjam as $buku)
                    <a href="{{ route('buku.show', ['buku' => $buku->id]) }}"
                        class="image-cover overflow-hidden rounded-lg h-full w-12 bg-white">
                        <img src="{{ asset('assets/sampul_buku/' . $buku->sampul_buku) }}"
                            class="object-cover hover:scale-110 duration-300 transition-transform ease-in-out">
                    </a>
                @empty
                    <p class="text-center text-xl text-violet-300 font-semibold mt-10">Tidak Ada Buku yang Paling Banyak
                        Dipinjam.</p>
                @endforelse
            </div>
            <button data-controls="pinjamPrev"
                class="absolute top-1/2 left-0 transform -translate-y-1/2 px-2 py-1 bg-gray-900 hover:bg-violet-500 text-gray-100 opacity-80 hover:opacity-100 duration-300 rounded-l-md">
                <i class="fa-solid fa-chevron-left mr-2"></i>Prev
            </button>
            <button data-controls="pinjamNext"
                class="absolute top-1/2 right-0 transform -translate-y-1/2 px-2 py-1 bg-gray-900 hover:bg-violet-500 text-gray-100 opacity-80 hover:opacity-100 duration-300 rounded-r-md">
                Next<i class="fa-solid fa-chevron-right ml-2"></i>
            </button>
        </div>
    </div>
    <div class="mt-16">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold">Baru di Tambahkan</h1>
            <a href="{{ route('buku.index') }}"
                class="flex items-center text-sm md:text-md hover:text-violet-500 duration-300 group">
                <p>Lihat Seluruh Buku</p>
                <i class="fa-solid fa-arrow-right ml-2 group-hover:ml-1 group-hover:text-violet-500 duration-300"></i>
            </a>
        </div>
        <div class="baruSlider relative">
            <div class="baru-carousel flex items-center gap-x-4">
                @forelse ($bukus as $b)
                    <a href="{{ route('buku.show', ['buku' => $b->id]) }}"
                        class="image-cover overflow-hidden rounded-lg h-full w-12 bg-white">
                        <img src="{{ asset('assets/sampul_buku/' . $b->sampul_buku) }}"
                            class="object-cover hover:scale-110 duration-300 transition-transform ease-in-out">
                    </a>
                @empty
                    <p class="text-center text-xl text-violet-300 font-semibold mt-10">Tidak Ada Buku Terbaru.</p>
                @endforelse
            </div>
            <button data-controls="baruPrev"
                class="absolute top-1/2 left-0 transform -translate-y-1/2 px-2 py-1 bg-gray-900 hover:bg-violet-500 text-gray-100 opacity-80 hover:opacity-100 duration-300 rounded-l-md">
                <i class="fa-solid fa-chevron-left mr-2"></i>Prev
            </button>
            <button data-controls="baruNext"
                class="absolute top-1/2 right-0 transform -translate-y-1/2 px-2 py-1 bg-gray-900 hover:bg-violet-500 text-gray-100 opacity-80 hover:opacity-100 duration-300 rounded-r-md">
                Next<i class="fa-solid fa-chevron-right ml-2"></i>
            </button>
        </div>
    </div>
    <div class="mt-16">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold">Koleksi</h1>
            <a href="{{ route('koleksi.index') }}"
                class="flex items-center text-sm md:text-md hover:text-violet-500 duration-300 group">
                <p>Lihat Seluruh Koleksimu</p>
                <i class="fa-solid fa-arrow-right ml-2 group-hover:ml-1 group-hover:text-violet-500 duration-300"></i>
            </a>
        </div>
        <div class="koleksiSlider relative">
            <div class="koleksi-carousel flex items-center gap-x-4">
                @forelse ($koleksi as $k)
                    <div class="image-cover overflow-hidden rounded-lg h-full w-12 bg-white">
                        <img src="https://cdnwpseller.gramedia.net/wp-content/uploads/2021/10/08113013/MATAHARI-TERE-LIYE.jpg"
                            class="object-cover hover:scale-110 duration-300 transition-transform ease-in-out">
                    </div>
                @empty
                    <p class="text-center text-xl text-violet-300 font-semibold mt-10">Tidak Ada Buku yang Dikoleksi.</p>
                @endforelse
            </div>
            <button data-controls="koleksiPrev"
                class="absolute top-1/2 left-0 transform -translate-y-1/2 px-2 py-1 bg-gray-900 hover:bg-violet-500 text-gray-100 opacity-80 hover:opacity-100 duration-300 rounded-l-md">
                <i class="fa-solid fa-chevron-left mr-2"></i>Prev
            </button>
            <button data-controls="koleksiNext"
                class="absolute top-1/2 right-0 transform -translate-y-1/2 px-2 py-1 bg-gray-900 hover:bg-violet-500 text-gray-100 opacity-80 hover:opacity-100 duration-300 rounded-r-md">
                Next<i class="fa-solid fa-chevron-right ml-2"></i>
            </button>
        </div>
    </div>
    <div class="mt-16 mb-16">
        <h1 class="text-2xl md:text-3xl font-bold">Pencarian Buku</h1>
        <p class="text-md md:text-lg font-semibold">Isi Input Pencarian, Kategori, dan atau Genre Buku</p>
        <form class="mt-6" action="{{ route('buku.index') }}">
            @csrf
            <div class="flex flex-col lg:flex-row">
                <label for="category-select" class="mb-2 text-sm font-medium text-gray-900 sr-only">Pilih Kategori</label>
                <select id="category-select" name="kategori_id"
                    class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-violet-500 bg-white border border-gray-300 rounded-t-lg lg:rounded-tr-none lg:rounded-s-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-violet-100">
                    <option value="" selected>Seluruh Kategori</option>
                    @foreach ($kategoris as $k)
                        <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                    @endforeach
                </select>
                <label for="category-select" class="mb-2 text-sm font-medium text-gray-900 sr-only">Pilih Kategori</label>
                <select id="category-select" name="genre_id"
                    class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-violet-500 bg-white border border-gray-300 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-violet-100">
                    <option value="" selected>Seluruh Genre</option>
                    @foreach ($genres as $g)
                        <option value="{{ $g->id }}">{{ $g->genre }}</option>
                    @endforeach
                </select>
                <div class="relative w-full">
                    <input type="search" id="search-dropdown" name="keyword"
                        class="block p-2.5 w-full z-20 text-sm bg-white rounded-e-lg lg:border-s-gray-50 border-lg lg:border-s-2 border border-gray-300 focus:ring-violet-500 focus:border-violet-500 text-violet-500"
                        placeholder="Cari Buku Berdasarkan Judul Buku, No ISBN, Penulis, Penerbit, atau Tahun Terbit">
                    <button type="submit"
                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-fuchsia-700 rounded-none lg:rounded-e-lg border border-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:outline-none focus:ring-fuchsia-300">
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
@endsection
