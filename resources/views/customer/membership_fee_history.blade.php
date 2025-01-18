<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Lịch sử đóng hội phí
            </h1>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex flex-column p-3 border rounded shadow-sm" style="max-width: 600px;">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size: 14px; color: #BF5805; font-weight: 600; width:180px;">Tên Thành Viên</span>
                        <span style="font-size: 14px; color: #803B03; font-weight: 700;">{{ $customer->full_name ?? $customer->business_name_vi }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size: 14px; color: #BF5805; font-weight: 600; width:180px;">Số Điện Thoại</span>
                        <span style="font-size: 14px; color: #803B03; font-weight: 700;">{{ $customer->phone }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size: 14px; color: #BF5805; font-weight: 600; width:180px;">Trạng Thái Hoạt Động</span>
                        <span class="badge {{ $customer->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $customer->status ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                        </span>
                    </div>
            
                    <div class="d-flex justify-content-between">
                        <span style="font-size: 14px; color: #BF5805; font-weight: 600; width:180px;">Tổng Hội Phí Đã Đóng</span>
                        <span style="font-size: 14px; color: #803B03; font-weight: 700;">
                            {{ number_format($totalFeesPaid, 0, ',', '.') }} VNĐ
                        </span>
                    </div>
                </div>
            </div>
            

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="membership-fees-history" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h1 style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 500; line-height: 18.75px; text-align: left; color: #BF5805;"
                            class="mb-1">
                            Năm
                        </h1>

                        <div class="d-flex justify-content-between align-items-center">
                            <form id="membershipFeeSearchForm" method="GET"
                                action="{{ route('board_customer.membership-fee-history', $customer->id) }}"
                                class="d-flex mb-3">
                                <div class="d-flex align-items-center">
                                    <select id="year" name="year" class="form-control me-3"
                                        style="max-width: 200px;" onchange="this.form.submit()">
                                        <option value="" {{ request('year') == '' ? 'selected' : '' }}>Tất cả
                                        </option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"
                                                {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </form>

                            <form id="searchForm" method="GET"
                                action="{{ route('board_customer.membership-fee-history', $customer->id) }}"
                                class="d-flex mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        value="{{ request('search') }}" placeholder="Tìm kiếm nội dung...">
                                    <button class="btn btn-outline-secondary" type="submit"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm w-100">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th class="text-center" style="border: none;">STT</th>
                                        <th style="border: none;">Năm</th>
                                        <th style="border: none;">Ngày đóng hội phí</th>
                                        <th style="border: none;">Số tiền phải đóng (VNĐ)</th>
                                        <th style="border: none;">Nội dung</th>
                                        <th style="border: none;">Tình trạng</th>
                                        <th style="border: none;">Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fees as $index => $fee)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $fee->year }}</td>
                                            <td>{{ \Carbon\Carbon::parse($fee->payment_date)->format('d/m/Y') }}</td>
                                            <td>{{ number_format($fee->amount_due, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $fee->content ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $fee->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $fee->status ? 'Đã hoàn thành' : 'Chưa hoàn thành' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($fee->attachment)
                                                    <a href="{{ asset('storage/' . $fee->attachment) }}"
                                                        target="_blank"
                                                        style="text-decoration: underline; color: #803B03;">
                                                        Xem file đính kèm
                                                    </a>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="d-flex justify-content-center">
                                {{ $feesHistory->links('pagination::bootstrap-5') }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
        </div>
    </div>
</x-app-layout>
