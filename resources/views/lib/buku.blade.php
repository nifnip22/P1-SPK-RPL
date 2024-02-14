@extends('lib.layouts.main')

@section('main-content')
    <div class="mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 justify-between items-center gap-y-3">
            <h1 class="text-2xl md:text-3xl font-bold">Buku</h1>
            <form action="{{ route('buku.index') }}" method="GET">
                @csrf
                <div class="flex">
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" name="keyword"
                            class="block p-2.5 w-full z-20 text-sm bg-gray-50 rounded-lg border border-gray-300 focus:ring-violet-500 focus:border-violet-500 text-violet-500"
                            placeholder="Cari Buku Berdasarkan Judul Buku, No ISBN, Penulis, Penerbit, atau Tahun Terbit"
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
        @if (Auth::user()->level === 'Admin')
            <button type="button" data-modal-target="static-modal" data-modal-toggle="static-modal"
                class="p-2 bg-violet-500 hover:bg-violet-700 duration-300 text-gray-100 rounded-lg mb-4"><i
                    class="fas fa-plus mr-1"></i> Tambah Buku</button>

            <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Tambah Buku
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="static-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5" action="{{ route('buku.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-2 gap-y-3 mb-5">
                                <div>
                                    <label for="sampul_buku" class="block mb-2 text-sm font-medium text-gray-900">Sampul
                                        Buku</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 @error('sampul_buku') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror rounded-lg cursor-pointer bg-gray-50"
                                        aria-describedby="file_input_help" id="file_input" type="file" name="sampul_buku"
                                        accept=".png, .jpg, .jpeg" required>
                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG/JPEG (Max: 5MB)
                                    </p>
                                    @error('sampul_buku')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="judul_buku" class="block mb-2 text-sm font-medium text-gray-900">Judul
                                        Buku</label>
                                    <input type="text" name="judul_buku" id="judul_buku"
                                        class="bg-gray-50 border  border-gray-300 text-gray-900 @error('judul_buku') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        placeholder="Masukkan Judul Buku" required="" maxlength="255">
                                    @error('judul_buku')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="no_isbn" class="block mb-2 text-sm font-medium text-gray-900">No
                                        ISBN</label>
                                    <input type="number" name="no_isbn" id="no_isbn" min="0"
                                        class="bg-gray-50 border  border-gray-300 text-gray-900 @error('no_isbn') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        placeholder="Masukkan Nomor ISBN Buku" required="">
                                    @error('no_isbn')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="penulis_buku" class="block mb-2 text-sm font-medium text-gray-900">Penulis
                                        Buku</label>
                                    <input type="text" name="penulis_buku" id="penulis_buku"
                                        class="bg-gray-50 border  border-gray-300 text-gray-900 @error('penulis_buku') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        placeholder="Masukkan Penulis Buku" required="" maxlength="255">
                                    @error('penulis_buku')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="penerbit_buku"
                                        class="block mb-2 text-sm font-medium text-gray-900">Penerbit
                                        Buku</label>
                                    <input type="text" name="penerbit_buku" id="penerbit_buku"
                                        class="bg-gray-50 border  border-gray-300 text-gray-900 @error('penerbit_buku') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        placeholder="Masukkan Penerbit Buku" required="" maxlength="255">
                                    @error('penerbit_buku')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="tahun_terbit" class="block mb-2 text-sm font-medium text-gray-900">Tahun
                                        Terbit</label>
                                    <input type="number" min="0"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        name="tahun_terbit" id="tahun_terbit"
                                        class="bg-gray-50 border  border-gray-300 text-gray-900 @error('tahun_terbit')
invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500
@enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        placeholder="Masukkan Tahun Terbit" required="" maxlength="4">
                                    @error('tahun_terbit')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="jumlah_halaman"
                                        class="block mb-2 text-sm font-medium text-gray-900">Jumlah Halaman</label>
                                    <input type="number" name="jumlah_halaman" id="jumlah_halaman" min="0"
                                        class="bg-gray-50 border  border-gray-300 text-gray-900 @error('jumlah_halaman') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        placeholder="Masukkan Jumlah Halaman" required="">
                                    @error('jumlah_halaman')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="kategori_buku"
                                        class="block mb-2 text-sm font-medium text-gray-900">Kategori
                                        Buku</label>
                                    <select id="kategori_buku" name="kategori_id" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                        <option selected="">Pilih Kategori Buku</option>
                                        @foreach ($kategoris as $k)
                                            <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="genre_buku" class="block mb-2 text-sm font-medium text-gray-900">Genre
                                        Buku</label>
                                    <select id="genre_buku" name="genre_id" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                        <option selected="">Pilih Genre Buku</option>
                                        @foreach ($genres as $g)
                                            <option value="{{ $g->id }}">{{ $g->genre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi
                                        Buku</label>
                                    <textarea id="deskripsi" rows="4" name="deskripsi"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Ketikkan Deskripsi Buku"></textarea>
                                </div>
                                <div>
                                    <label for="bahasa" class="block mb-2 text-sm font-medium text-gray-900">Bahasa
                                        Buku</label>
                                    <select id="bahasa" name="bahasa" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                        <option selected="">Pilih Bahasa Buku</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Inggris">Inggris</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Tambah Buku
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if (request('keyword'))
            <div class="mt-2 mb-4">
                <p class="text-md font-semibold">Berdasarkan Kata Kunci: <span
                        class="text-fuchsia-500">'{{ request('keyword') }}'</span></p>
            </div>
        @endif
        <div class="flex flex-wrap justify-center xl:justify-start items-center gap-x-3 gap-y-6">
            @forelse ($bukus as $b)
                <a href="{{ route('buku.show', ['buku' => $b->id]) }}" class="book flex flex-col group w-40">
                    <div class="grid grid-cols-2 items-center text-xs text-center text-gray-100">
                        <div class="bg-violet-500 px-3 py-1 rounded-tl-lg">{{ $b->kategori->kategori }}</div>
                        <div class="bg-gray-900 px-3 py-1 rounded-tr-lg">{{ $b->genre->genre }}</div>
                    </div>
                    <div class="image-cover overflow-hidden h-56 bg-white duration-300 rounded-b-lg">
                        <img src="{{ asset('assets/sampul_buku/' . $b->sampul_buku) }}"
                            class="object-cover h-full w-full group-hover:scale-110 duration-300 transition-transform ease-in-out">
                    </div>
                    <div class="detail text-center mt-2">
                        <h1 class="text-md md:text-lg font-semibold group-hover:text-violet-500 duration-300">
                            {{ $b->judul_buku }}</h1>
                        <p class="text-sm md:text-md font-medium group-hover:text-violet-500 duration-300 truncate">
                            {{ $b->penulis_buku }}</p>
                    </div>
                </a>
            @empty
                <p class="text-center text-xl text-violet-300 font-semibold mt-10">Tidak Ada Buku yang Ditambahkan.</p>
            @endforelse
        </div>
    </div>
@endsection
