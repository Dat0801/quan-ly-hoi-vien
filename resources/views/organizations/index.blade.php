<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;" class="mb-3">
                Danh sách Tổ Chức
            </h1>

            @include('category.navigation')

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                    <div class="d-flex align-items-start">
                        <div class="bg-white sm:rounded-lg" style="flex: 1;">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h1 class="mb-1" style="color: #BF5805;">Tìm kiếm</h1>

                            <div class="d-flex align-items-center">
                                <form method="GET" action="{{ route('organizations.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tổ chức...">
                                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                @if ($organizations->isNotEmpty())
                                    <table class="table mt-3 table-sm w-100">
                                        <thead style="background-color: #FFE3CD; color: #803B03;">
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th>Mã Tổ Chức</th>
                                                <th>Tên Tổ Chức</th>
                                                <th>Mô tả</th>
                                                <th class="text-center">Hoạt động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($organizations as $index => $organization)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $organization->organization_code }}</td>
                                                    <td>{{ $organization->organization_name }}</td>
                                                    <td>{{ $organization->description ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('organizations.show', $organization->id) }}" class="me-1" style="cursor: pointer">
                                                            <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                                        </a>
                                                        <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display:inline;" id="deleteOrganizationForm-{{ $organization->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn-sm text-danger"
                                                                onclick="showModal('Bạn có chắc chắn muốn xóa tổ chức này?', function() { submitOrganizationForm('{{ $organization->id }}'); }, function() { })">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $organizations->links('pagination::bootstrap-5') }}
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
            <a href="{{ route('organizations.create') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addOrganizationButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm Tổ Chức</span>
            </a>
        </div>
    </div>
</x-app-layout>
