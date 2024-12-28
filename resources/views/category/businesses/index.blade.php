<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;" class="mb-3">
                Danh Sách Doanh Nghiệp
            </h1>

            @include('category.navigation')

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="business" role="tabpanel" aria-labelledby="business-tab">
                    <div class="d-flex align-items-start">
                        <div class="bg-white sm:rounded-lg" style="flex: 1;">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h1 class="mb-1" style="color: #BF5805;">Tìm kiếm</h1>

                            <div class="d-flex align-items-center">
                                <form method="GET" action="{{ route('business.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm doanh nghiệp...">
                                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                @if ($businesses->isNotEmpty())
                                    <table class="table mt-3 table-sm w-100">
                                        <thead style="background-color: #FFE3CD; color: #803B03;">
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th>Mã Doanh Nghiệp</th>
                                                <th>Tên Doanh Nghiệp</th>
                                                <th>Mô tả</th>
                                                <th class="text-center">Hoạt động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($businesses as $index => $business)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $business->business_code }}</td>
                                                    <td>{{ $business->business_name }}</td>
                                                    <td>{{ $business->description ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('business.show', $business->id) }}" class="me-1" style="cursor: pointer">
                                                            <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                                        </a>
                                                        <form action="{{ route('business.destroy', $business->id) }}" method="POST" style="display:inline;" id="deleteBusinessForm-{{ $business->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn-sm text-danger"
                                                                onclick="showModal('Bạn có chắc chắn muốn xóa doanh nghiệp này?', function() { submitBusinessForm('{{ $business->id }}'); }, function() { })">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $businesses->links('pagination::bootstrap-5') }}
                                @else
                                    <p>Không tìm thấy kết quả phù hợp.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('business.create') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addBusinessButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm Doanh Nghiệp</span>
            </a>
        </div>
    </div>
</x-app-layout>
