<x-app-layout>
    <div style="margin-right: 110px;">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 80vh; overflow-y: auto;">
            <h1 class="mb-4"
                style="
                font-family: 'Roboto', sans-serif;
                font-size: 32px;
                font-weight: 700;
                line-height: 38.4px;
                color: #803B03;">
                Chi tiết Hạng Thành Viên
            </h1>

            <div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tier_name" class="form-label">Tên Hạng</label>
                        <input type="text" id="tier_name"
                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500"
                            value="{{ $membershipTier->name }}" disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="required_fee" class="form-label">Mức phí phải nộp (VNĐ)</label>
                        <input type="text" id="required_fee"
                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500"
                            value="{{ number_format($membershipTier->fee, 0, ',', '.') }} VNĐ" disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea id="description" rows="3" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>{{ $membershipTier->description }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="minimum_contribution" class="form-label">Đóng góp tối thiểu (VNĐ)</label>
                        <input type="text" id="minimum_contribution"
                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500"
                            value="{{ number_format($membershipTier->minimum_contribution, 0, ',', '.') }} VNĐ"
                            disabled>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <x-cancel-button :route="route('membership_tier.index')">
                        Đóng
                    </x-cancel-button>
                    <x-primary-button :route="route('membership_tier.edit', $membershipTier->id)">
                        Chỉnh sửa
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
