<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách thông báo
            </h1>

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="notifications-list" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <h1 style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: 500;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;"
                                        class="mb-1">
                                        Thời gian
                                    </h1>
                                    <form id="timeFilterForm" method="GET" action="{{ route('notification.index') }}">
                                        <div class="d-flex align-items-center">
                                            <input type="date" name="start_date" class="form-control me-2"
                                                value="{{ request('start_date') }}" placeholder="Từ ngày"
                                                style="max-width: 160px;">
                                            <input type="date" name="end_date" class="form-control"
                                                value="{{ request('end_date') }}" placeholder="Đến ngày"
                                                style="max-width: 160px;">
                                        </div>
                                    </form>
                                </div>

                                <div class="me-3">
                                    <h1 style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: 500;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;"
                                        class="mb-1">
                                        Hình thức
                                    </h1>
                                    <form id="formatFilterForm" method="GET"
                                        action="{{ route('notification.index') }}" onchange="this.submit()">
                                        <select name="format" class="form-select" style="max-width: 200px;">
                                            <option value="" {{ request('format') === null ? 'selected' : '' }}>
                                                Tất cả hình thức</option>
                                            <option value="email" {{ request('format') == 'email' ? 'selected' : '' }}>
                                                Email</option>
                                            <option value="sms" {{ request('format') == 'sms' ? 'selected' : '' }}>
                                                SMS</option>
                                        </select>
                                    </form>
                                </div>
                            </div>

                            <div class="ms-2">
                                <h1 style="
                                    font-family: 'Roboto', sans-serif;
                                    font-size: 16px;
                                    font-weight: 500;
                                    line-height: 18.75px;
                                    text-align: left;
                                    color: #BF5805;"
                                    class="mb-1">
                                    Tìm kiếm
                                </h1>
                                <form id="notificationSearchForm" method="GET"
                                    action="{{ route('notification.index') }}" class="d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}" placeholder="Tìm kiếm tiêu đề...">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="">
                            <table class="table mt-3 table-sm w-100">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th class="text-center" style="border: none;">STT</th>
                                        <th style="border: none;">Tiêu đề</th>
                                        <th style="border: none;">Hình thức</th>
                                        <th style="border: none; text-align: center;">Thời gian gửi</th>
                                        <th style="border: none; text-align: center;">Số người nhận</th>
                                        <th style="border: none;">Người tạo</th>
                                        <th style="border: none; text-align: center;">Ngày tạo</th>
                                        <th style="border: none;">Trạng thái</th>
                                        <th class="text-center" style="border: none;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $index => $notification)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">
                                                {{ ($notifications->currentPage() - 1) * $notifications->perPage() + $index + 1 }}
                                            </td>
                                            <td>{{ $notification->title }}</td>
                                            <td>{{ ucfirst($notification->format) }}</td>
                                            <td style="text-align: center">{{ $notification->sent_at }}</td>
                                            <td style="text-align: center">{{ $notification->recipients->count() }}
                                            </td>
                                            <td>{{ $notification->creator->name }}</td>
                                            <td style="text-align: center">{{ $notification->created_at }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $notification->sent_at <= now() ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $notification->sent_at <= now() ? 'Đã gửi' : 'Chưa gửi' }}
                                                </span>
                                            </td>
                                            <td class="text-center">


                                                @if ($notification->sent_at <= now())
                                                    <a href="{{ route('notification.show', $notification->id) }}"
                                                        class="me-1" style="cursor: pointer">
                                                        <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('notification.edit', $notification->id) }}"
                                                        class="me-1" style="cursor: pointer">
                                                        <i class="fas fa-edit" style="color: #FF7506"></i>
                                                    </a>
                                                @endif

                                                <form action="{{ route('notification.destroy', $notification->id) }}"
                                                    method="POST" style="display:inline;"
                                                    id="deleteNotificationForm-{{ $notification->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-sm text-danger"
                                                        onclick="showModal('Bạn có chắc chắn muốn xóa thông báo này?', function() { submitNotificationForm('{{ $notification->id }}'); }, function() { })">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $notifications->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg"
            id="addNewButtonContainer">
            <a href="{{ route('notification.create') }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;"
                id="addNotificationButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm mới</span>
            </a>
        </div>
    </div>
</x-app-layout>
