@extends('lib.layouts.main')

@section('main-content')
    <div class="mt-4">
        <h1 class="text-2xl md:text-3xl font-bold">Detail Buku</h1>
    </div>
    <div class="mt-10">
        <div class="flex flex-col md:flex-row gap-x-4 justify-center md:justify-start">
            <div
                class="bg-white ring-2 ring-violet-500 rounded-lg overflow-hidden w-72 h-full mx-auto md:mx-0 md:sticky md:top-20">
                <img src="{{ asset('assets/sampul_buku/' . $bukus->sampul_buku) }}"
                    class="object-cover transition-transform ease-in-out">
            </div>
            <div class="w-full p-4">
                <div class="title text-center md:text-start">
                    <div class="flex flex-row justify-center md:justify-start items-center text-gray-100 mb-4">
                        <a class="bg-violet-500 px-3 py-1 rounded-lg mr-3">{{ $bukus->kategori->kategori }}</a>
                        <a class="bg-gray-900 px-3 py-1 rounded-lg mr-6">{{ $bukus->genre->genre }}</a>
                        <svg class="w-4 h-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <p class="ms-2 text-sm font-bold text-gray-900 mr-6">{{ $averageRating }}</p>
                        <i class="fa fa-bookmark text-gray-900"></i>
                        <p class="ms-2 text-sm font-bold text-gray-900">{{ $koleksiCount }}</p>
                    </div>
                    <p class="text-lg md:text-xl font-semibold">{{ $bukus->penulis_buku }}</p>
                    <h1 class="text-4xl md:text-5xl font-bold">{{ $bukus->judul_buku }}</h1>

                    <div class="mt-12 flex flex-wrap justify-center md:justify-start items-center gap-3">
                        @php
                            $isPeminjamanExist = App\Models\PeminjamanBuku::where('user_id', Auth::user()->id)
                                ->where('buku_id', $bukus->id)
                                ->exists();
                            $buttonClass = $isPeminjamanExist ? 'bg-green-500 cursor-not-allowed' : 'bg-fuchsia-500 hover:bg-fuchsia-700 duration-300';
                            $icon = $isPeminjamanExist ? 'fa-check' : 'fa-book-open-reader';
                            $buttonText = $isPeminjamanExist ? 'Di Pinjam' : 'Pinjam Buku';
                        @endphp

                        <button type="button" data-modal-target="modalPinjam" data-modal-toggle="modalPinjam"
                            class="px-4 py-2 rounded-lg text-gray-100 text-lg {{ $buttonClass }}"
                            @if ($isPeminjamanExist) disabled @endif>
                            <i class="fas {{ $icon }}"></i> {{ $buttonText }}
                        </button>

                        <button data-modal-target="modalInfo" data-modal-toggle="modalInfo"
                            class="block bg-transparent text-blue-700 hover:text-blue-800 duration-300 font-medium rounded-lg text-sm px-3 py-2 text-center"
                            type="button">
                            <i class="fas fa-circle-info fa-lg"></i>
                        </button>
                        <button type="button" onclick="toggleKoleksi()" data-buku-id="{{ $bukus->id }}"
                            class="ml-4 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-800 duration-300 text-gray-100 text-lg"><i
                                id="bookmark-icon"
                                class="{{ $bookmarkStatus === 'bookmarked' ? 'fas' : 'far' }} fa-bookmark"></i>
                            Koleksi</button>

                        @if (Auth::user()->level === 'Admin' || Auth::user()->level === 'Petugas')
                            <button type="button" data-modal-target="editBuku" data-modal-toggle="editBuku"
                                class="ml-4 px-4 py-2 rounded-lg bg-yellow-600 hover:bg-yellow-800 duration-300 text-gray-100 text-lg"><i
                                    class="fas fa-edit"></i> Edit</button>
                            <form action="{{ route('buku.destroy', ['buku' => $bukus->id]) }}" method="POST"
                                id="deleteBuku-form-{{ $bukus->id }}" data-id="{{ $bukus->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="deleteBuku-button ml-4 px-4 py-2 rounded-lg bg-red-600 hover:bg-red-800 duration-300 text-gray-100 text-lg"><i
                                        class="fas fa-trash"></i> Hapus</button>
                            </form>
                        @endif

                        {{-- Modal Pinjam --}}
                        <div id="modalPinjam" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            Peminjaman Buku
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="modalPinjam">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <h4 class="text-lg font-semibold">Buku yang Ingin di Pinjamkan:
                                            {{ $bukus->judul_buku }}</h4>
                                        <form class="space-y-4" action="{{ route('peminjaman.store') }}" method="POST">
                                            @csrf
                                            <div class="hidden">
                                                <label for="user"
                                                    class="block mb-2 text-sm font-medium text-gray-900">User</label>
                                                <input type="text" name="user_id" id="user"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5"
                                                    required value="{{ Auth::user()->id }}">
                                            </div>
                                            <div class="hidden">
                                                <label for="buku"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Buku</label>
                                                <input type="text" name="buku_id" id="buku"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5"
                                                    required value="{{ $bukus->id }}">
                                            </div>
                                            <div>
                                                <label for="tanggalPinjam"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                                    Peminjaman</label>
                                                <input type="date" name="tanggal_peminjaman" id="tanggalPinjam"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5"
                                                    required>
                                            </div>
                                            <div>
                                                <label for="tanggalKembali"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                                    Pengembalian</label>
                                                <input type="date" name="tanggal_pengembalian" id="tanggalKembali"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5"
                                                    required readonly>
                                            </div>
                                            <button type="submit"
                                                class="w-full text-white bg-violet-500 hover:bg-violet-700 focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Pinjam Buku</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Info --}}
                        <div id="modalInfo" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            Sekilas Info
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="modalInfo">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4">
                                        <p class="text-base leading-relaxed text-gray-500">
                                            Sebelum melakukan peminjaman, pastikan Anda telah membaca dan memahami syarat
                                            dan
                                            ketentuan
                                            peminjaman. Pastikan juga untuk memeriksa ketersediaan barang yang ingin Anda
                                            pinjam.
                                        </p>
                                        <p class="text-base leading-relaxed text-gray-500">
                                            Pengembalian barang harus dilakukan tepat waktu sesuai dengan perjanjian
                                            peminjaman.
                                            Dengan
                                            melakukan peminjaman, Anda setuju untuk mematuhi semua ketentuan yang berlaku.
                                        </p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                                        <button data-modal-hide="modalInfo" type="button"
                                            class="text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Saya
                                            Mengerti</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Edit Buku --}}
                        <div id="editBuku" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-6xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            Edit Buku
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="editBuku">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-4 md:p-5" action="{{ route('buku.update', ['buku' => $bukus->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-x-2 gap-y-3 mb-5">
                                            <div class="col-span-2">
                                                <label for="judul_buku"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Judul
                                                    Buku</label>
                                                <input type="text" name="judul_buku" id="judul_buku"
                                                    class="bg-gray-50 border  border-gray-300 text-gray-900 @error('judul_buku') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    placeholder="Masukkan Judul Buku" required="" maxlength="255"
                                                    value="{{ $bukus->judul_buku }}">
                                                @error('judul_buku')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-span-2">
                                                <label for="no_isbn"
                                                    class="block mb-2 text-sm font-medium text-gray-900">No
                                                    ISBN</label>
                                                <input type="number" name="no_isbn" id="no_isbn" min="0"
                                                    class="bg-gray-50 border  border-gray-300 text-gray-900 @error('no_isbn') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    placeholder="Masukkan Nomor ISBN Buku" required=""
                                                    value="{{ $bukus->no_isbn }}">
                                                @error('no_isbn')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="penulis_buku"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Penulis
                                                    Buku</label>
                                                <input type="text" name="penulis_buku" id="penulis_buku"
                                                    class="bg-gray-50 border  border-gray-300 text-gray-900 @error('penulis_buku') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    placeholder="Masukkan Penulis Buku" required="" maxlength="255"
                                                    value="{{ $bukus->penulis_buku }}">
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
                                                    placeholder="Masukkan Penerbit Buku" required="" maxlength="255"
                                                    value="{{ $bukus->penerbit_buku }}">
                                                @error('penerbit_buku')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="tahun_terbit"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Tahun
                                                    Terbit</label>
                                                <input type="number" min="0"
                                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                    name="tahun_terbit" id="tahun_terbit"
                                                    class="bg-gray-50 border  border-gray-300 text-gray-900 @error('tahun_terbit')
invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500
@enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    placeholder="Masukkan Tahun Terbit" required="" maxlength="4"
                                                    value="{{ $bukus->tahun_terbit }}">
                                                @error('tahun_terbit')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="jumlah_halaman"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                                                    Halaman</label>
                                                <input type="number" name="jumlah_halaman" id="jumlah_halaman"
                                                    min="0"
                                                    class="bg-gray-50 border  border-gray-300 text-gray-900 @error('jumlah_halaman') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    placeholder="Masukkan Jumlah Halaman" required=""
                                                    value="{{ $bukus->jumlah_halaman }}">
                                                @error('jumlah_halaman')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-span-2">
                                                <label for="kategori_buku"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Kategori
                                                    Buku</label>
                                                <select id="kategori_buku" name="kategori_id" required
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                    <option selected="" value="{{ $bukus->kategori->id }}">Dipilih
                                                        Sebelumnya: {{ $bukus->kategori->kategori }}</option>
                                                    @foreach ($kategoris as $k)
                                                        <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="genre_buku"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Genre
                                                    Buku</label>
                                                <select id="genre_buku" name="genre_id" required
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                    <option selected="" value="{{ $bukus->genre->id }}">Dipilih
                                                        Sebelumnya: {{ $bukus->genre->genre }}</option>
                                                    @foreach ($genres as $g)
                                                        <option value="{{ $g->id }}">{{ $g->genre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-3">
                                                <label for="deskripsi"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Deskripsi
                                                    Buku</label>
                                                <textarea id="deskripsi" rows="4" name="deskripsi"
                                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                    placeholder="Ketikkan Deskripsi Buku">{{ $bukus->deskripsi }}</textarea>
                                            </div>
                                            <div>
                                                <label for="bahasa"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Bahasa
                                                    Buku</label>
                                                <select id="bahasa" name="bahasa" required
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                    <option selected="" value="{{ $bukus->bahasa }}">Dipilih
                                                        Sebelumnya: {{ $bukus->bahasa }}</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Inggris">Inggris</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="text-white inline-flex items-center bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            <i class="fa fa-edit mr-1">
                                            </i>
                                            Edit Buku
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mt-2 italic">Tekan Tombol Info untuk Mengetahui Peminjaman Lebih Lanjut
                    </p>
                </div>
                <div class="deskripsi mt-16">
                    <h4 class="text-2xl font-semibold">Deskripsi</h4>
                    <p class="text-md">{{ $bukus->deskripsi }}</p>
                </div>
                <div class="detail mt-16">
                    <h4 class="text-2xl font-semibold mb-4">Detail</h4>
                    <div class="grid grid-cols-2 gap-x-1 gap-y-10">
                        <div class="flex flex-col">
                            <p class="text-md text-gray-500">No ISBN</p>
                            <h4 class="text-lg">{{ $bukus->no_isbn }}</h4>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-md text-gray-500">Penerbit Buku</p>
                            <h4 class="text-lg">{{ $bukus->penerbit_buku }}</h4>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-md text-gray-500">Tahun Terbit</p>
                            <h4 class="text-lg">{{ $bukus->tahun_terbit }}</h4>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-md text-gray-500">Jumlah Halaman</p>
                            <h4 class="text-lg">{{ $bukus->jumlah_halaman }}</h4>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-md text-gray-500">Bahasa</p>
                            <h4 class="text-lg">{{ $bukus->bahasa }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10">
        <div class="bg-white p-4 rounded-lg drop-shadow-md">
            <h1 class="text-lg font-semibold mb-4">Ulasan</h1>
            <form action="{{ Route('ulasan.store') }}" method="POST" class="mb-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-x-2 items-center">
                    <input type="text" name="user_id" value="{{ Auth::user()->id }}" class="hidden">
                    <input type="text" name="buku_id" value="{{ $bukus->id }}" class="hidden">
                    <textarea id="message" rows="4" name="ulasan"
                        class="sm:col-span-2 lg:col-span-3 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-violet-500 focus:border-violet-500"
                        placeholder="Berikan Ulasan dan Pendapatmu pada Buku ini..." required></textarea>
                    <select multiple required name="rating"
                        class="sm:col-span-2 lg:col-span-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5">
                        <option disabled selected>Pilih Rating</option>
                        <option value="5">5 (Sangat Bagus)</option>
                        <option value="4">4 (Bagus)</option>
                        <option value="3">3 (Cukup Bagus)</option>
                        <option value="2">2 (Kurang Bagus)</option>
                        <option value="1">1 (Tidak Bagus)</option>
                    </select>
                </div>
                <button type="submit"
                    class="bg-fuchsia-500 hover:bg-fuchsia-700 duration-300 p-2 mt-4 w-full rounded-lg text-gray-100"><i
                        class="fas fa-paper-plane"></i> Kirim
                    Ulasan</button>
            </form>
            <hr class="mb-6">
            <div class="komentar-section grid grid-cols-1">
                @foreach ($ulasan as $u)
                    <div class="flex items-center mb-1">
                        <h1
                            class="text-md font-semibold mr-3 {{ $u->user->name === $u->user->name ? 'text-violet-500' : '' }}">
                            {{ $u->user->name }}</h1>
                        <svg class="w-4 h-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        <p class="ms-1 text-sm font-bold text-gray-900">{{ $u->rating }}</p>
                    </div>
                    <p class="text-sm text-gray-500 mb-6">{{ $u->ulasan }}</p>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Fungsi Tanggal Pengembalian --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen input tanggal peminjaman
            var tanggalPeminjamanInput = document.getElementById("tanggalPinjam");
            // Ambil elemen input tanggal pengembalian
            var tanggalPengembalianInput = document.getElementById("tanggalKembali");

            // Tambahkan event listener untuk input tanggal peminjaman
            tanggalPeminjamanInput.addEventListener("change", function() {
                // Ambil tanggal peminjaman dari input
                var tanggalPeminjaman = new Date(this.value);
                // Tambahkan 30 hari ke tanggal peminjaman
                tanggalPeminjaman.setDate(tanggalPeminjaman.getDate() + 30);
                // Format tanggal pengembalian sebagai yyyy-mm-dd
                var tanggalPengembalian = tanggalPeminjaman.toISOString().split('T')[0];
                // Set nilai input tanggal pengembalian
                tanggalPengembalianInput.value = tanggalPengembalian;
            });
        });
    </script>

    {{-- Bookmark Status --}}
    <script>
        var bookmarkStatus = @json($bookmarkStatus);

        function toggleKoleksi() {
            var bukuId = $('[data-buku-id]').data('buku-id');

            $.ajax({
                url: '/buku/' + bukuId + '/koleksi',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status === 'bookmarked') {
                        new Noty({
                            text: '<i class="fa-solid fa-bookmark mr-2"></i> Buku di Koleksi!',
                            theme: 'mint',
                            type: 'info',
                            layout: 'bottomRight',
                            timeout: 3000,
                            progressBar: true,
                        }).show();

                        $('#bookmark-icon').removeClass('far').addClass('fas');
                        bookmarkStatus = 'bookmarked';
                    } else if (response.status === 'unbookmarked') {
                        new Noty({
                            text: '<i class="fa-regular fa-bookmark mr-2"></i> Buku Batal di Koleksi!',
                            theme: 'mint',
                            type: 'info',
                            layout: 'bottomRight',
                            timeout: 3000,
                            progressBar: true,
                        }).show();

                        $('#bookmark-icon').removeClass('fas').addClass('far');
                        bookmarkStatus = 'unbookmarked';
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endsection
