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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative" style="background-image: url('/images/BG.png'); 
                                    background-color:#FFE3CD;
                                    width: 1920px; 
                                    height: 1080px; 
                                    border-radius: 24px 0px 0px 0px; 
                                    opacity: 1;">

            <div class="absolute" style="top: 100px; left: 381px;">
                <a href="/">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo" style="width: 178px; height: 214px;" />
                </a>
            </div>

            <iv class="absolute" style="top: 139px; left: 847px;">
                <img src="{{ asset('images/Layer_1.png') }}" alt="Logo" style="width: 1027px; height: 851px;" />
            </div>

            <div class="absolute" style="top: 378px; left: 384px;">
                <h2 class="title-header" style="font-family: 'Roboto', sans-serif; 
                    font-size: 36px; 
                    font-weight: 700; 
                    line-height: 42.19px; 
                    text-align: left; 
                    text-underline-position: from-font; 
                    color: #803B03;
                    text-decoration-skip-ink: none">
                    {{ session('title', 'Đăng nhập') }}
                </h2>
            </div>
    
            <!-- Nội dung sẽ được đặt cố định với các giá trị pixel cụ thể -->
            <div class="absolute" style="top: 450px; left: 201px; width: 540px; height: 400px;">
                <div style="background-color:#FFE3CD;" >
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
