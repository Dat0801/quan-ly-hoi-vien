<x-app-layout>
    <div class="p-4 bg-white shadow-sm rounded-lg">
        <h1 class="mb-4"
            style="
            font-family: 'Roboto', sans-serif;
            font-size: 32px;
            font-weight: 700;
            line-height: 38.4px;
            color: #803B03;">
            Chỉnh sửa Hạng Thành Viên
        </h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('membership_tier.update', $membershipTier->id) }}">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Tên Hạng</label>
                    <input type="text" id="name" name="name" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500"
                        value="{{ old('name', $membershipTier->name) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fee" class="form-label">Mức Phí Phải Nộp (VNĐ)</label>
                    <input type="number" id="fee" name="fee" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500"
                        value="{{ old('fee', $membershipTier->fee) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">Mô Tả</label>
                    <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $membershipTier->description) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="minimum_contribution" class="form-label">Đóng Góp Tối Thiểu (VNĐ)</label>
                    <input type="number" id="minimum_contribution" name="minimum_contribution" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500"
                        value="{{ old('minimum_contribution', $membershipTier->minimum_contribution) }}" required>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('membership_tier.index') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
            </div>
        </form>
    </div>
</x-app-layout>
