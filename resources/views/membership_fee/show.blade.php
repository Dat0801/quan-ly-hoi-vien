<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;" class="mb-3">
                Chi tiết hội phí: {{ $fee->customer->full_name ?? $fee->customer->business_name_vi ?? 'N/A' }}
            </h1>

            <div class="bg-white sm:rounded-lg">
                <table class="table mt-3 table-sm">
                    <thead style="background-color: #FFE3CD; color: #803B03;">
                        <tr>
                            <th style="border: none;">Năm</th>
                            <th style="border: none;">Số tiền phải thu (VNĐ)</th>
                            <th style="border: none;">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fees as $fee)
                            <tr>
                                <td>{{ $fee->year }}</td>
                                <td>{{ number_format($fee->amount_due, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <span class="badge {{ $fee->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $fee->status ? 'Đã hoàn thành' : 'Chưa hoàn thành' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('membership_fee.index') }}" class="btn btn-outline-primary w-32 py-2 sm:rounded-lg">Đóng</a>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
        </div>
    </div>
</x-app-layout>
