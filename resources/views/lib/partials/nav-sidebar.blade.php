<div class="navSidebar">
    <nav class="fixed top-0 z-50 w-full bg-white border-b-4 border-fuchsia-500">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="{{ route('beranda.index') }}" class="flex ms-2 md:me-24">
                        <img src="{{ asset('assets/img/png/libranest_logo.png') }}" class="h-8 me-3" alt="LibraNest" />
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full" src="{{ asset('assets/img/png/user.png') }}"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Profile</a>
                                </li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                            class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100"
                                            role="menuitem">Logout</a>
                                    </li>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('beranda.index') }}"
                        class="flex items-center p-2 {{ request()->is('beranda*') ? 'text-violet-600 bg-fuchsia-100 border-l-4 border-fuchsia-400' : 'text-gray-900 hover:bg-gray-100 transition duration-300' }} rounded-lg group">
                        <i class="fas fa-home fa-lg"></i>
                        <span class="ms-3">Beranda</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base {{ request()->is('buku*') || request()->is('koleksi*') || request()->is('kategori*') ? 'text-violet-600' : 'text-gray-900 hover:bg-gray-100 transition duration-300' }} rounded-lg group"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <i class="fa fa-book fa-lg"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Buku</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="py-2 space-y-2">
                        <li>
                            <a href="{{ route('buku.index') }}"
                                class="flex items-center w-full p-2 {{ request()->is('buku*') ? 'text-violet-600 bg-fuchsia-100 border-l-4 border-fuchsia-400' : 'text-gray-900 hover:bg-gray-100 transition duration-300' }} rounded-lg pl-11 group"><i
                                    class="fa-solid fa-layer-group mr-2"></i> Seluruh Buku</a>
                        </li>
                        <li>
                            <a href="{{ route('koleksi.index') }}"
                                class="flex items-center w-full p-2 {{ request()->is('koleksi*') ? 'text-violet-600 bg-fuchsia-100 border-l-4 border-fuchsia-400' : 'text-gray-900 hover:bg-gray-100 transition duration-300' }} rounded-lg pl-11 group"><i
                                    class="fa-solid fa-bookmark mr-2"></i> Koleksi</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('transaksi.index') }}"
                        class="flex items-center p-2 {{ request()->is('transaksi*') ? 'text-violet-600 bg-fuchsia-100 border-l-4 border-fuchsia-400' : 'text-gray-900 hover:bg-gray-100 transition duration-300' }} rounded-lg group">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        <span class="ms-3">Transaksi</span>
                    </a>
                </li>
                @if (Auth::user()->level === 'Admin' || Auth::user()->level === 'Petugas')
                    <li>
                        <a href="{{ route('transaksi.indexPetugas') }}"
                            class="flex items-center p-2 {{ request()->routeIs('transaksi.indexPetugas') ? 'text-violet-600 bg-fuchsia-100 border-l-4 border-fuchsia-400' : 'text-gray-900 hover:bg-gray-100 transition duration-300' }} rounded-lg group">
                            <i class="fa-solid fa-check-to-slot"></i>
                            <span class="ms-3">Peminjaman</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->level === 'Admin')
                    <li>
                        <a href="{{ route('petugas.index') }}"
                            class="flex items-center p-2 {{ request()->routeIs('petugas.index') ? 'text-violet-600 bg-fuchsia-100 border-l-4 border-fuchsia-400' : 'text-gray-900 hover:bg-gray-100 transition duration-300' }} rounded-lg group">
                            <i class="fa-solid fa-id-card-clip"></i>
                            <span class="ms-3">Petugas</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>
</div>
