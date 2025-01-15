<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách tài khoản
            </h1>

            @include('user.navigation')

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel">
                    <div class="d-flex align-items-start">
                        <div class="bg-white sm:rounded-lg" style="flex: 1;">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex">
                                    <div class="me-2" style="width: 200px;">
                                        <h1 style="
                                            font-family: 'Roboto', sans-serif;
                                            font-size: 16px;
                                            font-weight: 500;
                                            line-height: 18.75px;
                                            text-align: left;
                                            color: #BF5805;"
                                            class="mb-1">
                                            Trạng thái hoạt động
                                        </h1>
                                        <form id="filterFormStatus" method="GET" action="{{ route('account.index') }}"
                                            class="d-flex" onchange="this.submit()">
                                            <select name="status" class="form-control" style="width: 100%;">
                                                <option value=""
                                                    {{ request('status') === null ? 'selected' : '' }}>
                                                    Tất cả</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                                    Hoạt động</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                                    Ngưng hoạt động</option>
                                            </select>
                                        </form>
                                    </div>
                            
                                    <div class="me-2" style="width: 200px;">
                                        <h1 style="
                                            font-family: 'Roboto', sans-serif;
                                            font-size: 16px;
                                            font-weight: 500;
                                            line-height: 18.75px;
                                            text-align: left;
                                            color: #BF5805;"
                                            class="mb-1">
                                            Vai trò
                                        </h1>
                                        <form id="filterFormRole" method="GET" action="{{ route('account.index') }}"
                                            class="d-flex" onchange="this.submit()">
                                            <select name="role_id" class="form-control" style="width: 100%;">
                                                <option value=""
                                                    {{ request('role_id') === null ? 'selected' : '' }}>
                                                    Tất cả</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ request('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->role_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </div>

                                <div class="ms-2">
                                    <form id="accountSearchForm" method="GET" action="{{ route('account.index') }}"
                                        class="d-flex">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}" placeholder="Tìm kiếm tài khoản...">
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
                                            <th style="border: none;">Tên đăng nhập</th>
                                            <th style="border: none;">Tên người dùng</th>
                                            <th style="border: none;">Số điện thoại</th>
                                            <th style="border: none;">Vai trò</th>
                                            <th style="border: none;">Trạng thái</th>
                                            <th style="border: none;">Truy cập lần cuối</th>
                                            <th class="text-center" style="border: none;">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($accounts as $index => $account)
                                            <tr style="background-color: transparent;">
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $account->email }}</td>
                                                <td>{{ $account->name }}</td>
                                                <td>{{ $account->phone_number ?? '-' }}</td>
                                                <td>{{ $account->role->role_name ?? '-' }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $account->status ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $account->status ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                                                    </span>
                                                </td>
                                                <td>{{ $account->last_login ? $account->last_login->format('d/m/Y H:i') : '-' }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('account.show', $account->id) }}" class="me-1"
                                                        style="cursor: pointer">
                                                        <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                                    </a>

                                                    @if (!$account->status)
                                                        <form action="{{ route('account.destroy', $account->id) }}"
                                                            method="POST" style="display:inline;"
                                                            id="deleteAccountForm-{{ $account->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn-sm text-danger"
                                                                onclick="showModal('Bạn có chắc chắn muốn xóa tài khoản này?', function() { submitAccountForm('{{ $account->id }}'); }, function() { })">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $accounts->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('account.create') }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addAccountButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm tài khoản</span>
            </a>
        </div>
    </div>
</x-app-layout>
