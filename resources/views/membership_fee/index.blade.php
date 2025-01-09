<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách hội phí
            </h1>

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="membership-fees-list" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Bộ lọc bên trái: Thời gian và Trạng thái -->
                            <div class="d-flex align-items-center">
                                <!-- Thời gian -->
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
                                    <form id="timeFilterForm" method="GET" action="{{ route('membership_fee.index') }}">
                                        <div class="d-flex align-items-center">
                                            <input type="date" name="start_date" class="form-control me-2"
                                                value="{{ request('start_date') }}" placeholder="Từ ngày" style="max-width: 160px;">
                                            <input type="date" name="end_date" class="form-control"
                                                value="{{ request('end_date') }}" placeholder="Đến ngày" style="max-width: 160px;">
                                        </div>
                                    </form>
                                </div>
                        
                                <!-- Trạng thái -->
                                <div class="me-3">
                                    <h1 style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: 500;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;"
                                        class="mb-1">
                                        Trạng thái
                                    </h1>
                                    <form id="statusFilterForm" method="GET" action="{{ route('membership_fee.index') }}" onchange="this.submit()">
                                        <select name="status" class="form-select" style="max-width: 200px;">
                                            <option value="" {{ request('status') === null ? 'selected' : '' }}>Tất cả trạng thái</option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đã hoàn thành</option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Chưa hoàn thành</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        
                            <!-- Tìm kiếm bên phải -->
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
                                <form id="membershipFeeSearchForm" method="GET" action="{{ route('membership_fee.index') }}" class="d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}" placeholder="Tìm kiếm khách hàng...">
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
                                        <th style="border: none;">Tên khách hàng</th>
                                        <th style="border: none;">Năm</th>
                                        <th style="border: none;">Số tiền phải thu (VNĐ)</th>
                                        <th style="border: none;">Trạng thái</th>
                                        <th class="text-center" style="border: none;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fees as $index => $fee)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ ($fees->currentPage() - 1) * $fees->perPage() + $index + 1 }}</td>
                                            <td>{{ $fee->customer->full_name ?? $fee->customer->business_name_vi ?? '-' }}</td>
                                            <td>{{ $fee->year }}</td>
                                            <td>{{ number_format($fee->amount_due, 0, ',', '.') }} VNĐ</td>
                                            <td>
                                                <span class="badge {{ $fee->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $fee->status ? 'Đã hoàn thành' : 'Chưa hoàn thành' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('membership_fee.show', $fee->id) }}"
                                                    class="me-1" style="cursor: pointer">
                                                    <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $fees->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('membership_fee.create') }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;"
                id="addMembershipFeeButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm mới</span>
            </a>
        </div>
    </div>
</x-app-layout>
