<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách đối tác doanh nghiệp
            </h1>

            @include('club.navigation')

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="business-partner-info" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h1 style="
                                font-family: 'Roboto', sans-serif;
                                font-size: 16px;
                                font-weight: 500;
                                line-height: 18.75px;
                                text-align: left;
                                text-underline-position: from-font;
                                text-decoration-skip-ink: none;
                                color: #BF5805;"
                                class="mb-1"
                            >Phân loại</h1>

                        <div class="d-flex justify-content-between align-items-center">
                            <form id="partnerCategorySelectForm" method="GET" action="{{ route('club.business_partner.index', $club->id) }}" class="d-flex" onchange="this.submit()">
                                <select name="partner_category" class="form-control">
                                    <option value="" {{ request('partner_category') === null ? 'selected' : '' }}>Tất cả</option>
                                    <option value="Việt Nam" {{ request('partner_category') == 'Việt Nam' ? 'selected' : '' }}>Việt Nam</option>
                                    <option value="Quốc tế" {{ request('partner_category') == 'Quốc tế' ? 'selected' : '' }}>Quốc tế</option>
                                </select>
                            </form>

                            <div class="ms-2">
                                <form id="partnerSearchForm" method="GET"
                                    action="{{ route('club.business_partner.index', $club->id) }}" class="d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}" placeholder="Tìm kiếm...">
                                        <button class="btn btn-outline-secondary" type="submit"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Bảng hiển thị thông tin -->
                        <div class="">
                            <table class="table mt-3 table-sm w-100">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th class="text-center" style="border: none;">STT</th>
                                        <th style="border: none;">Mã đối tác</th>
                                        <th style="border: none;">Tên đối tác</th>
                                        <th style="border: none;">Phân loại</th>
                                        <th style="border: none;">Tình trạng hoạt động</th>
                                        <th class="text-center" style="border: none;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businessPartners as $index => $partner)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $partner->login_code }}</td>
                                            <td>{{ $partner->business_name_vi }}</td>
                                            <td>{{ $partner->partner_category }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $partner->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $partner->status ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0" type="button"
                                                        id="actionDropdown-{{ $partner->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-vertical" style="color: #FF7506"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="actionDropdown-{{ $partner->id }}">
                                                        <li>
                                                            <a href="{{ route('club.business_partner.show', [$partner->id,$club->id]) }}"
                                                                class="dropdown-item" style="color: #BF5805">
                                                                Chi tiết
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('club.business_partner.edit', [$partner->id,$club->id]) }}"
                                                                class="dropdown-item" style="color: #BF5805">
                                                                Chỉnh sửa
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('club.business_partner.destroy', [$partner->id,$club->id]) }}"
                                                                method="POST"
                                                                id="deleteBusinessPartnerForm-{{ $partner->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="dropdown-item text-danger"
                                                                    onclick="showModal('Bạn có chắc chắn muốn xóa đối tác này?', function() { submitBusinessPartnerForm('{{ $partner->id }}'); }, function() { })">
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
                                {{ $businessPartners->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nút thêm mới -->
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('club.business_partner.create', $club->id) }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addPartnerButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm mới</span>
            </a>
        </div>
    </div>
</x-app-layout>
