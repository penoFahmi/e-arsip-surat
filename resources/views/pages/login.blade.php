<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('public/sneat/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login Petugas | {{ config('app.name') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat/css/demo.css') }}" />

    <style>
        body,
        html {
            height: 100%;
            overflow-x: hidden;
            background-color: #f5f5f9;
        }

        .login-row {
            min-height: 100vh;
        }

        .login-left {
            background-image: url("{{ asset('bg-login.png') }}");
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(13, 71, 161, 0.9), rgba(21, 101, 192, 0.8));
            z-index: 1;
        }

        .login-branding {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .login-right {
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-form-container {
            width: 100%;
            max-width: 400px;
        }

        .btn-primary {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }

        .btn-primary:hover {
            background-color: #002171;
            border-color: #002171;
        }

        a {
            color: #0d47a1;
        }
    </style>
</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0 login-row">

            <div class="col-lg-7 col-md-6 d-none d-md-flex login-left">
                <div class="login-branding">
                    <img src="{{ asset('logo-black.png') }}" alt="Logo BKAD"
                        style=" invert(1); max-width: 120px; margin-bottom: 20px;">
                    <h2 class="text-white fw-bold mb-1">E-Arsip Surat</h2>
                    <h4 class="text-white fw-light">
                        Solusi digital untuk memastikan setiap dokumen <strong>Surat</strong> tersimpan aman dan terpusat.
                    </h4>
                </div>
            </div>

            <div class="col-lg-5 col-md-6 login-right">
                <div class="login-form-container">
                    <div class="text-center mb-4 d-md-none">
                        <img src="{{ asset('logo-black.png') }}" alt="Logo" width="60px">
                    </div>

                    <div class="mb-4">
                        <h3 class="fw-bold mb-1" style="color: #0d47a1;">Selamat Datang!</h3>
                        <p class="text-muted">Silakan masuk ke akun Anda.</p>
                    </div>

                    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <x-input-form name="email" type="email" :label="__('model.user.email')" />
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <x-input-form name="password" type="password" :label="__('model.user.password')" />
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                                <label class="form-check-label" for="remember-me"> Ingat Saya </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100 py-2" type="submit">
                                {{ __('menu.auth.login') }}
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-5 small text-muted">
                        <p class="mb-0">
                            &copy; {{ date('Y') }} <strong>{{ config('app.name') }}</strong>
                        </p>
                        <p class="mb-0">
                            {{ config('app.name') }}
                        </p>
                        <div class="mt-2">
                            <small>Developed by <a href="https://github.com/penoFahmi" target="_blank"
                                    class="fw-bold">Peno</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('sneat/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('sneat/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sneat/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('sneat/js/main.js') }}"></script>

</body>

</html>
