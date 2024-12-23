<x-app-layout>
    <div class="d-flex align-items-start">
        <!-- Left div with profile information -->
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1;">
            <div class="max-w-xl">
                <h1>Tài liệu lưu trữ</h1>
            </div>
        </div>

        <!-- Right buttons container -->
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg">
            <!-- Edit Button with smaller size -->
            <a href="{{ route('profile.edit') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm file mới</span>
            </a>
        </div>
    </div>
</x-app-layout>
