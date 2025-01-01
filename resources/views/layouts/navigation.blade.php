<!-- resources/views/layouts/navigation.blade.php -->

<nav x-data="{ open: false }">
    <div class="d-flex justify-content-between align-items-center h-16 w-full">
        <div class="d-flex align-items-center">
            @if (!request()->is('dashboard'))
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            @foreach ($breadcrumbs as $breadcrumb)
                                <li class="breadcrumb-item @if ($breadcrumb['active']) active @endif">
                                    @if (!$breadcrumb['active'])
                                        <a href="{{ $breadcrumb['url'] }}" style="color: grey; font-weight:bold">{{ $breadcrumb['name'] }}</a>
                                    @else
                                        <span style="color: #FF7506; font-weight: bold;">{{ $breadcrumb['name'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div>
            @endif
        </div>

        <!-- User Settings (phần tử bên phải) -->
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <a href="{{ route('profile.show') }}" 
                class="inline-flex items-center text-sm leading-4 font-medium rounded-md text-gray-500 
                hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <!-- Avatar -->
                <div class="flex items-center space-x-3">
                    <img src="{{ Auth::check() && Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '/images/avt.png' }}" alt="User Avatar" 
                    class="w-8 h-8 mr-2" style="border-radius: 50%; object-fit: cover;">
                    <div class="text-left">
                        <div style="color: #803B03;">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->role->role_name }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</nav>
