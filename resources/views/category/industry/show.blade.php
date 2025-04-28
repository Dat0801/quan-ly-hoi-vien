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
        <div class="p-4 bg-white shadow-sm rounded-lg w-100">
            <h1 class="mb-4" style="
                font-family: 'Roboto', sans-serif;
                font-size: 32px;
                font-weight: 700;
                line-height: 38.4px;
                color: #803B03;">Chi tiết ngành</h1>

            <form>
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="industry_code" class="form-label">Mã ngành <span class="text-danger">*</span></label>
                        <input type="text" id="industry_code" name="industry_code" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required value="{{ $industry->industry_code }}" disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="industry_name" class="form-label">Tên ngành <span class="text-danger">*</span></label>
                        <input type="text" id="industry_name" name="industry_name" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required value="{{ $industry->industry_name }}" disabled>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea id="description" name="description" rows="3" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>{{ $industry->description }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <x-cancel-button :route="route('industry.index')">
                        Đóng
                    </x-cancel-button>
                    <x-primary-button :route="route('industry.edit', $industry->id)">
                        Chỉnh sửa
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
