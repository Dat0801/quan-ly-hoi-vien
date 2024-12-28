<x-app-layout :hideSidebar="true">
    <div style="margin-right: 110px;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 80vh; overflow-y: auto;">
            <h1 class="mb-4" style="
                font-family: 'Roboto', sans-serif;
                font-size: 32px;
                font-weight: 700;
                line-height: 38.4px;
                color: #803B03;">
                Chi tiết lĩnh vực
            </h1>

            <!-- Form Show -->
            <div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Tên lĩnh vực</label>
                        <input type="text" id="name" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" value="{{ $field->name }}" disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="industry" class="form-label">Ngành</label>
                        <input type="text" id="industry" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" value="{{ $field->industry->industry_name }}" disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="code" class="form-label">Mã lĩnh vực</label>
                        <input type="text" id="code" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" value="{{ $field->code }}" disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea id="description" rows="3" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>{{ $field->description }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="form-label">Nhóm con</label>
                    @foreach($field->subGroups as $subGroup)
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control mb-2" value="{{ $subGroup->name }}" disabled>
                            <textarea class="form-control mb-2" disabled>{{ $subGroup->description }}</textarea>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('field.index') }}?tab={{ request()->get('tab', 'fields') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Quay lại</a>
                    <a href="{{ route('field.edit', $field->id) }}" class="btn btn-primary w-48 py-3 sm:rounded-lg">Chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
