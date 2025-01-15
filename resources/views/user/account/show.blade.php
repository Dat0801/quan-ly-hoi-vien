<x-app-layout>
    <div style="margin-right: 110px;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;" class="mb-3">Thông tin người dùng</h1>

            <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Tên đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Tên đăng nhập</label>
                                <input type="email" id="email" name="email" value="{{ $account->email }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                            </div>

                            <!-- Tên người dùng -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên</label>
                                <input type="text" id="name" name="name" value="{{ $account->name }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone_number" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                <input type="text" id="phone_number" name="phone_number" value="{{ $account->phone_number }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                            </div>

                            <!-- Vai trò -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="role_id" class="form-label mb-0 me-2" style="width: 250px;">Vai trò</label>
                                <input type="text" id="role_id" name="role_id" value="{{ $account->role->role_name }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                            </div>

                            <div class="d-flex align-items-center">
                                <label for="status" class="form-label mb-0 me-2" style="width: 180px;">Trạng thái</label>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge {{ $account->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $account->status ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                                    </span>
                                </div>
                                
                            </div>

                            <div class="d-flex align-items-center">
                                <label class="form-label mb-0 me-2" style="width: 180px;">Ảnh đại diện</label>
                                <div class="avatar-upload-box position-relative" style="width: 120px; height: 120px;">
                                    <img id="avatar-image" class="img-fluid w-100 h-100 object-fit-cover rounded-3" 
                                    src="{{ isset($account) && $account->avatar ? asset('storage/' . $account->avatar) : '' }}" alt="Avatar" 
                                    style="z-index: 1; {{ isset($account) && $account->avatar ? '' : 'display: none;' }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('account.index') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
                    <a href="{{ route('account.edit', $account->id) }}" class="btn btn-primary w-48 py-3 sm:rounded-lg">Chỉnh sửa</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
