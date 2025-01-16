<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách khách hàng doanh nghiệp
            </h1>

            @include('club.navigation')

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="board-business-customer" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex">
                                <div class="me-2">
                                    <h1 style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: 500;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;"
                                        class="mb-1">
                                        Lĩnh vực
                                    </h1>
                                    <form id="filterForm" method="GET" action="{{ route('club.business_customer.index', $club->id) }}"
                                        class="d-flex" onchange="this.submit()">
                                        <select name="field_id" class="form-control">
                                            <option value="" {{ request('field_id') === null ? 'selected' : '' }}>
                                                Tất cả
                                            </option>
                                            @foreach ($fields as $field)
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
                                        class="mb-1">
                                        Thị trường
                                    </h1>
                                    <form id="filterForm" method="GET" action="{{ route('club.business_customer.index', $club->id) }}"
                                        class="d-flex" onchange="this.submit()">
                                        <select name="market_id" class="form-control">
                                            <option value=""
                                                {{ request('market_id') === null ? 'selected' : '' }}>Tất cả</option>
                                            @foreach ($markets as $market)
                                                <option value="{{ $market->id }}"
                                                    {{ request('market_id') == $market->id ? 'selected' : '' }}>
                                                    {{ $market->market_name }}
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
                                        class="mb-1">
                                        Khách hàng mục tiêu
                                    </h1>
                                    <form id="filterForm" method="GET" action="{{ route('club.business_customer.index', $club->id) }}"
                                        class="d-flex" onchange="this.submit()">
                                        <select name="target_customer_group_id" class="form-control">
                                            <option value=""
                                                {{ request('target_customer_group_id') === null ? 'selected' : '' }}>Tất cả</option>
                                            @foreach ($targetCustomerGroups as $group)
                                                <option value="{{ $group->id }}"
                                                    {{ request('target_customer_group_id') == $group->id ? 'selected' : '' }}>
                                                    {{ $group->group_name }}
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
                                        class="mb-1">
                                        Tình trạng hoạt động
                                    </h1>
                                    <form id="statusSelectForm" method="GET" action="{{ route('club.business_customer.index', $club->id) }}" class="d-flex" onchange="this.submit()">
                                        <select name="status" class="form-control">
                                            <option value="" {{ request('status') === null ? 'selected' : '' }}>Tất cả</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động</option>
                                        </select>
                                    </form>
                                </div>
                            </div>

                            <!-- Tìm kiếm -->
                            <div class="ms-2">
                                <form id="customerSearchForm" method="GET"
                                    action="{{ route('club.business_customer.index', $club->id) }}" class="d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}" placeholder="Tìm kiếm...">
                                        <button class="btn btn-outline-secondary" type="submit"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="">
                            <table class="table mt-3 table-sm w-100">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th class="text-center" style="border: none;">STT</th>
                                        <th style="border: none;">Mã khách hàng</th>
                                        <th style="border: none;">Tên khách hàng</th>
                                        <th style="border: none;">Lĩnh vực</th>
                                        <th style="border: none;">Thị trường</th>
                                        <th style="border: none;">Khách hàng mục tiêu</th>
                                        <th style="border: none;">Tình trạng hoạt động</th>
                                        <th class="text-center" style="border: none;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $index => $customer)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $customer->login_code }}</td>
                                            <td>{{ $customer->business_name_vi }}</td>
                                            <td>{{ $customer->field->name }}</td>
                                            <td>{{ $customer->market->market_name }}</td>
                                            <td>{{ $customer->targetCustomerGroup->group_name }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $customer->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $customer->status ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0" type="button"
                                                        id="actionDropdown-{{ $customer->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-vertical" style="color: #FF7506"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="actionDropdown-{{ $customer->id }}">
                                                        <li>
                                                            <a href="{{ route('club.business_customer.show', [$club->id, $customer->id]) }}"
                                                                class="dropdown-item" style="color: #BF5805">
                                                                Chi tiết
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('club.business_customer.edit', [$club->id, $customer->id]) }}"
                                                                class="dropdown-item" style="color: #BF5805">
                                                                Chỉnh sửa
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('club.business_customer.destroy', [$club->id, $customer->id]) }}"
                                                                method="POST"
                                                                id="deleteBusinessCustomerForm-{{ $customer->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="dropdown-item text-danger"
                                                                    onclick="showModal('Bạn có chắc chắn muốn xóa khách hàng doanh nghiệp này?', function() { submitBusinessCustomerForm('{{ $customer->id }}'); }, function() { })">
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
                                {{ $customers->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('club.business_customer.create', $club->id) }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addCustomerButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm mới</span>
            </a>
        </div>
    </div>
</x-app-layout>
