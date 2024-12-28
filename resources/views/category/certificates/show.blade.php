<x-app-layout :hideSidebar="true">
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
        <div class="p-4 bg-white shadow-sm rounded-lg w-100">
            <h1 class="mb-4" style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                Chi Tiết Chứng Chỉ
            </h1>

            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="certificate_code" class="form-label">Mã Chứng Chỉ</label>
                        <input type="text" id="certificate_code" class="form-control border-gray-300 shadow-sm" value="{{ $certificate->certificate_code }}" disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="certificate_name" class="form-label">Tên Chứng Chỉ</label>
                        <input type="text" id="certificate_name" class="form-control border-gray-300 shadow-sm" value="{{ $certificate->certificate_name }}" disabled>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea id="description" rows="3" class="form-control border-gray-300 shadow-sm" disabled>{{ $certificate->description }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('certificates.index') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
                    <a href="{{ route('certificates.edit', $certificate->id) }}" class="btn btn-primary w-48 py-3 sm:rounded-lg">Chỉnh sửa</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
