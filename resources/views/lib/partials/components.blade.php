{{-- TNS --}}
<script>
    var pinjamSlider = tns({
        container: '.pinjam-carousel',
        items: 2,
        slideBy: 1,
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        rewind: true,
        prevButton: '[data-controls="pinjamPrev"]',
        nextButton: '[data-controls="pinjamNext"]',
        responsive: {
            640: {
                edgePadding: 5,
            },
            700: {
                // gutter: 30
            },
            900: {
                items: 4
            }
        }
    });

    var baruSlider = tns({
        container: '.baru-carousel',
        items: 2,
        slideBy: 1,
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        rewind: true,
        prevButton: '[data-controls="baruPrev"]',
        nextButton: '[data-controls="baruNext"]',
        responsive: {
            640: {
                edgePadding: 5,
            },
            700: {
                // gutter: 30
            },
            900: {
                items: 4
            }
        }
    });

    var koleksiSlider = tns({
        container: '.koleksi-carousel',
        items: 2,
        slideBy: 1,
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        rewind: true,
        prevButton: '[data-controls="koleksiPrev"]',
        nextButton: '[data-controls="koleksiNext"]',
        responsive: {
            640: {
                edgePadding: 5,
            },
            700: {
                // gutter: 30
            },
            900: {
                items: 4
            }
        }
    });
</script>

@if (session('petugas_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Petugas Berhasil di Register!"
            });
        });
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.deletePetugas-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const dataId = button.closest('form').getAttribute(
                    'data-id');

                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda Yakin Petugas ini Dihapus?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus!',
                    confirmButtonColor: 'red',
                    denyButtonText: `<i class="fa fa-times"></i> Batal`,
                    denyButtonColor: 'grey',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(
                            `deletePetugas-form-${dataId}`);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@if (session('deletePetugas_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Petugas Berhasil di Hapus!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif
@if (session('deletePetugas_error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif

@if (session('tambahBuku_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Buku Berhasil di Tambahkan!"
            });
        });
    </script>
@endif
@if (session('tambahBuku_error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "Terjadi Kesalahan!"
            });
        });
    </script>
@endif
@if (session('editBuku_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Buku Berhasil di Edit!"
            });
        });
    </script>
@endif
@if (session('editBuku_error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "Terjadi Kesalahan!"
            });
        });
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.deleteBuku-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const dataId = button.closest('form').getAttribute(
                    'data-id');

                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda Yakin Buku ini Dihapus?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus!',
                    confirmButtonColor: 'red',
                    denyButtonText: `<i class="fa fa-times"></i> Batal`,
                    denyButtonColor: 'grey',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(
                            `deleteBuku-form-${dataId}`);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@if (session('deleteBuku_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Buku Berhasil di Hapus!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif
@if (session('deleteBuku_error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif
@if (session('ulasan'))
    <script>
        new Noty({
            text: '<i class="fa-solid fa-message mr-2"></i> Ulasan Anda Telah Terkirim!',
            theme: 'mint',
            type: 'info',
            layout: 'bottomRight',
            timeout: 3000,
            progressBar: true,
        }).show();
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.deletePeminjaman-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const dataId = button.closest('form').getAttribute(
                    'data-id');

                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Buku Sudah di Kembalikan?',
                    text: 'Pastikan Buku Sudah Benar-benar di Kembalikan!',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: '<i class="fa fa-check"></i> Dikembalikan!',
                    confirmButtonColor: 'blue',
                    denyButtonText: `<i class="fa fa-times"></i> Batal`,
                    denyButtonColor: 'grey',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(
                            `deletePeminjaman-form-${dataId}`);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@if (session('deletePeminjaman_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Buku yang di Pinjam Berhasil di Kembalikan!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif
@if (session('deletePeminjaman_error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif
