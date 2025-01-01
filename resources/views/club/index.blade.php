<x-app-layout>
    <div class="d-flex align-items-start" >
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle" style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;" class="mb-3">
                Danh sách câu lạc bộ
            </h1>

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="club" role="tabpanel">
                    <div class="d-flex align-items-start">
                        <!-- Main Content -->
                        <div class="bg-white sm:rounded-lg" style="flex: 1;">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Lĩnh vực và Thị trường Select nằm sát nhau bên trái -->
                                <div class="d-flex">
                                    <div class="me-2">
                                        <h1 style="
                                            font-family: 'Roboto', sans-serif;
                                            font-size: 16px;
                                            font-weight: 500;
                                            line-height: 18.75px;
                                            text-align: left;
                                            color: #BF5805;"
                                            class="mb-1"
                                        >
                                            Lĩnh vực
                                        </h1>
                                        <form id="filterForm" method="GET" action="{{ route('club.index') }}" class="d-flex" onchange="this.submit()">
                                            <select name="field_id" class="form-control">
                                                <option value="" {{ request('field_id') === null ? 'selected' : '' }}>Tất cả lĩnh vực</option>
                                                @foreach($fields as $field)
                                                    <option value="{{ $field->id }}" 
                                                        {{ request('field_id') == $field->id ? 'selected' : '' }}>
                                                        {{ $field->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                            
                                    <div class="me-2">
                                        <h1 style="
                                            font-family: 'Roboto', sans-serif;
                                            font-size: 16px;
                                            font-weight: 500;
                                            line-height: 18.75px;
                                            text-align: left;
                                            color: #BF5805;"
                                            class="mb-1"
                                        >
                                            Thị trường
                                        </h1>
                                        <form id="filterForm" method="GET" action="{{ route('club.index') }}" class="d-flex" onchange="this.submit()">
                                            <select name="market_id" class="form-control">
                                                <option value="" {{ request('market_id') === null ? 'selected' : '' }}>Tất cả thị trường</option>
                                                @foreach($markets as $market)
                                                    <option value="{{ $market->id }}" 
                                                        {{ request('market_id') == $market->id ? 'selected' : '' }}>
                                                        {{ $market->market_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            
                                <!-- Tìm kiếm -->
                                <div class="ms-2">
                                    <form id="clubSearchForm" method="GET" action="{{ route('club.index') }}" class="d-flex">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm câu lạc bộ...">
                                            <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            

                            <div class="">
                                <table class="table mt-3 table-sm w-100">
                                    <thead style="background-color: #FFE3CD; color: #803B03;">
                                        <tr>
                                            <th class="text-center" style="border: none;">STT</th>
                                            <th style="border: none;">Tên câu lạc bộ</th>
                                            <th style="border: none;">Lĩnh vực</th>
                                            <th style="border: none;">Thị trường</th>
                                            <th style="border: none;">Số lượng thành viên</th>
                                            <th style="border: none;">Tình trạng hoạt động</th>
                                            <th class="text-center" style="border: none;">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clubs as $index => $club)
                                            <tr style="background-color: transparent;">
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $club->name_vi }}</td>
                                                <td>{{ $club->field->name ?? '-' }}</td>
                                                <td>{{ $club->market->market_name ?? '-' }}</td>
                                                <td>{{ $club->members_count }}</td>
                                                <td>
                                                    <span class="badge {{ $club->status ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $club->status ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-link p-0" type="button" id="actionDropdown-{{ $club->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-vertical" style="color: #FF7506"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown-{{ $club->id }}">
                                                            <li>
                                                                <a href="{{ route('club.show', $club->id) }}" class="dropdown-item" style="color: #BF5805">
                                                                    Chi tiết câu lạc bộ
                                                                </a>
                                                            </li>
                                                            <li>
                                                                {{-- {{ route('club.executive', $club->id) }} --}}
                                                                <a href="" class="dropdown-item" style="color: #BF5805">
                                                                    Ban điều hành
                                                                </a>
                                                            </li>
                                                            <li>
                                                                {{-- {{ route('club.customers', $club->id) }} --}}
                                                                <a href="" class="dropdown-item" style="color: #BF5805">
                                                                    Danh sách khách hàng
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('club.destroy', $club->id) }}" method="POST" id="deleteClubForm-{{ $club->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="dropdown-item text-danger" 
                                                                            onclick="showModal('Bạn có chắc chắn muốn xóa câu lạc bộ này?', function() { submitClubForm('{{ $club->id }}'); }, function() { })">
                                                                        Xóa
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $clubs->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('club.create') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addClubButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm mới</span>
            </a>

            <a href="{{ route('club.create') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addClubButton">
                <i class="fas fa-plus fa-lg" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Tải file lên</span>
            </a>

            <a href="{{ route('club.create') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addClubButton">
                <i class="fas fa-plus fa-lg" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Xuất file (.csv)</span>
            </a>

        </div>
    </div>
</x-app-layout>
