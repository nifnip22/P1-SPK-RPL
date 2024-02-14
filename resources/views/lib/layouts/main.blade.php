<!DOCTYPE html>
<html lang="en">

@include('lib.partials.head')

<body class="antialiased tracking-tight">

    @include('lib.partials.nav-sidebar')

    <main>
        <div class="bg-gray-100 p-4 mt-12 sm:ml-64 h-full">
            @yield('main-content')
        </div>
        <div class="bg-white p-4 sm:ml-64 h-full">
            <h4 class="text-md">Copyright 2024 LibraNest Indonesia, a part of LiteraNet Company</h4>
        </div>
    </main>

</body>

@include('lib.partials.components')

</html>
