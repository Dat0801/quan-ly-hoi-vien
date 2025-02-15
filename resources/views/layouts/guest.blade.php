<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Custom -->
    <link href="{{ secure_asset('css/custom.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ secure_asset('build/assets/app-d96bec99.css') }}">
    <script src="{{ secure_asset('build/assets/app-226659d9.js') }}"></script>
   

</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="container-fluid position-relative"
        style="background-image: url('/images/BG-guest.png'); background-color: #FFE3CD; background-size: cover; background-position: center; border-radius: 24px 0 0 0; height: 100vh;">

        <div class="d-flex flex-column align-items-center justify-content-center position-absolute container-content">

            <div class="mb-4">
                <a href="/">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="img-fluid logo" />
                </a>
            </div>

            <div>
                <h2 class="title-header">
                    {{ session('title', 'Đăng nhập') }}
                </h2>
            </div>

            <div class="form-container">
                {{ $slot }}
            </div>
        </div>

        <div class="position-absolute layer-image"
            style="top: 10%; right: 5%; max-width: 1027px; width: 50vw; height: auto;">
            <img src="{{ asset('images/Layer_1.png') }}" alt="Layer" class="img-fluid" />
        </div>
        <div class="copyright">
            Copyright &copy; 2020 Alta Software
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
