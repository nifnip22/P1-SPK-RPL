@extends('lib.layouts.main')

@section('main-content')
    <div class="mt-4">
        <h1 class="text-2xl md:text-3xl font-bold">Data Petugas</h1>
    </div>
    <div class="mt-10">
        <p class="text-gray-500 text-sm mt-2 mb-2">Admin dapat Menambah dan Menghapus Petugas LibraNest
        </p>
        <button type="button" data-modal-target="static-modal" data-modal-toggle="static-modal"
            class="mb-4 bg-green-600 hover:bg-green-700 duration-300 p-2 rounded-lg text-gray-100"><i class="fa fa-plus"></i>
            Tambah Petugas</button>

        <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Form Tambah Petugas
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('petugas.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-1">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 @error('name') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukkan Username Petugas" required="" maxlength="255">
                                @error('name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                    Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    class="bg-gray-50 border  border-gray-300 text-gray-900 @error('nama_lengkap') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap Petugas" required="" maxlength="255">
                                @error('nama_lengkap')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 @error('email') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukkan Email Petugas" required="" maxlength="255">
                                @error('email')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                <input type="password" name="password" id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 @error('password') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukkan Password Petugas" required="" maxlength="8">
                                @error('password')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation"
                                    class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 @error('password_confirmation') invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 @enderror text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Konfirmasi Password Petugas" required="" maxlength="8">
                                @error('password_confirmation')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="hidden">
                                <label for="level" class="block mb-2 text-sm font-medium text-gray-900">Level</label>
                                <input type="text" name="level" id="level"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    value="Petugas" required="">
                            </div>
                            <div class="hidden">
                                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                                <input type="text" name="alamat" id="alamat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    value="Petugas LibraNest" required="">
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
                            Tambah Petugas
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 drop-shadow-md">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Petugas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email Petugas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <i class="fa fa-cog fa-lg"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                    {{ $u->name }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                    {{ $u->nama_lengkap }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                    {{ $u->email }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('petugas.destroy', ['petugas' => $u->id]) }}" method="POST"
                                        id="deletePetugas-form-{{ $u->id }}" data-id="{{ $u->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="deletePetugas-button bg-red-500 hover:bg-red-700 duration-300 p-2 rounded-lg text-gray-100">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
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
