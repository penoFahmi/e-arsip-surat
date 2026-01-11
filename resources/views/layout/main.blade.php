<!DOCTYPE html>
<html
    lang="id"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('public/sneat/') }}"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>{{ config('app.name') }} - E-Arsip</title>
    <meta name="description" content="Sistem Arsip Digital BKAD"/>

    <link rel="icon" type="image/x-icon" href="{{ asset('logo-black.png') }}"/>

    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('sneat/vendor/fonts/boxicons.css')}}"/>

    <link rel="stylesheet" class="template-customizer-core-css" href="{{asset('sneat/vendor/css/core.css')}}"/>
    <link rel="stylesheet" class="template-customizer-theme-css" href="{{asset('sneat/vendor/css/theme-default.css')}}"/>
    <link rel="stylesheet" href="{{asset('sneat/css/demo.css')}}"/>

    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}"/>
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/sweetalert2/sweetalert2.min.css')}}"/>

    @stack('style')

    <script src="{{ asset('sneat/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('sneat/js/config.js') }}"></script>

    <style>
        /* Mengubah warna Primary (Ungu Sneat) menjadi Biru Dinas */
        :root {
            --bs-primary: #0d47a1; /* Biru Tua */
            --bs-primary-rgb: 13, 71, 161;
        }

        /* Background Aplikasi */
        body {
            background-color: #f5f7fa; /* Sedikit lebih kebiruan daripada abu-abu polos */
        }

        /* Override Tombol Primary */
        .btn-primary {
            background-color: #0d47a1 !important;
            border-color: #0d47a1 !important;
            box-shadow: 0 0.125rem 0.25rem 0 rgba(13, 71, 161, 0.4) !important;
        }
        .btn-primary:hover {
            background-color: #083275 !important;
            border-color: #083275 !important;
            transform: translateY(-1px);
        }

        /* Pagination & Link Active */
        .page-item.active .page-link, .pagination li.active > a:not(.page-link) {
            background-color: #0d47a1 !important;
            border-color: #0d47a1 !important;
        }

        /* Teks Selection */
        ::selection {
            background: #0d47a1;
            color: #fff;
        }

        /* Navbar Shadow yang lebih halus */
        .layout-navbar {
            box-shadow: 0 2px 15px rgba(0,0,0,0.04) !important;
        }
    </style>
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('components.sidebar')
        <div class="layout-page">

            @include('components.navbar')
            <div class="content-wrapper">

                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>
                @include('components.footer')
                <div class="content-backdrop fade"></div>
            </div>
            </div>
        </div>

    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<script src="{{ asset('sneat/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('sneat/vendor/libs/popper/popper.js')}}"></script>
<script src="{{ asset('sneat/vendor/js/bootstrap.js')}}"></script>
<script src="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{ asset('sneat/vendor/js/menu.js')}}"></script>

<script src="{{ asset('sneat/vendor/libs/masonry/masonry.js')}}"></script>
<script src="{{ asset('sneat/vendor/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>

<script src="{{ asset('sneat/js/main.js')}}"></script>

<script>
    // 1. Setup Toast Mixin (Notifikasi Pojok Kanan Atas)
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // 2. Setup Delete Confirmation (Menggunakan class .btn-delete)
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault(); // Mencegah submit form langsung
        var form = $(this).closest('form'); // Ambil form terdekat

        Swal.fire({
            title: '{{ __('menu.general.delete_confirm') }}',
            text: "{{ __('menu.general.delete_warning') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d47a1', // Sesuaikan warna konfirmasi dengan tema
            cancelButtonColor: '#8592a3',
            confirmButtonText: '{{ __('menu.general.delete') }}',
            cancelButtonText: '{{ __('menu.general.cancel') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
</script>

@if(session('success'))
    <script>
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        })
    </script>
@elseif(session('error'))
    <script>
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        })
    </script>
@elseif(session('info'))
    <script>
        Toast.fire({
            icon: 'info',
            title: "{{ session('info') }}"
        })
    </script>
@endif

@stack('script')

<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
