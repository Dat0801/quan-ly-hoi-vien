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
                color: #803B03;">Chỉnh Sửa Ngành</h1>

            <form action="{{ route('industry.update', $industry->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Dùng PUT để cập nhật --}}
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="industry_code" class="form-label">Mã Ngành <span class="text-danger">*</span></label>
                        <input type="text" id="industry_code" name="industry_code" 
                               class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" 
                               value="{{ old('industry_code', $industry->industry_code) }}" required>
                        @error('industry_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="industry_name" class="form-label">Tên Ngành <span class="text-danger">*</span></label>
                        <input type="text" id="industry_name" name="industry_name" 
                               class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" 
                               value="{{ old('industry_name', $industry->industry_name) }}" required>
                        @error('industry_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea id="description" name="description" rows="3" 
                                  class="form-control border-gray-300 shadow-sm focus:ring-indigo-500">{{ old('description', $industry->description) }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <x-cancel-button :route="route('industry.show', $industry->id)">
                        Hủy
                    </x-cancel-button>
                    <x-primary-button>
                        Lưu
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
