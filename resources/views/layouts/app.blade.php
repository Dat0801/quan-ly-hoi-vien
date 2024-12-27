<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="d-flex" style="height: 100vh;">
        @if(!isset($hideSidebar) || !$hideSidebar)
            @include('layouts.sidebar')
        @endif
        
        <!-- Main Content -->
        <div class="flex-grow-1 main-content" style="margin-left: 24px; margin-top: 24px;">

            <div style="margin-right: 110px;">
                @include('layouts.navigation')
            </div>

            @if (isset($header))
                <header class="bg-light p-3 shadow-sm mb-4">
                    <div class="container">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <div class="modal fade" id="dynamicModal" tabindex="-1" aria-labelledby="dynamicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #FF7506; color: white; text-align: center; justify-content: center; border: none;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 48px;"></i>
                </div>
                
                <div class="modal-body mt-3" style="background-color: white; text-align: center;">
                    <p id="modalMessage" style="color: #333; font-size: 18px;"></p>
                </div>
                
                <div class="modal-footer" style="justify-content: center; border-top: none;">
                    <button type="button" class="btn btn-outline-primary" id="cancelButton" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ '/js/modal.js' }}"></script>
    <script src="{{ '/js/sidebar.js' }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
