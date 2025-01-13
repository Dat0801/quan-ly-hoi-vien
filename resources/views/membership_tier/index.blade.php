<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách hạng thành viên
            </h1>

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="membership-tiers-list" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Tìm kiếm -->
                        <div class="d-flex justify-content-start mb-3">
                            <div class="">
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
                                <form id="membershipTierSearchForm" method="GET" action="{{ route('membership_tier.index') }}" class="d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}" placeholder="Tìm kiếm hạng thành viên...">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Bảng danh sách -->
                        <div class="">
                            <table class="table mt-3 table-sm w-100">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th class="text-center" style="border: none;">STT</th>
                                        <th style="border: none;">Tên hạng thành viên</th>
                                        <th style="border: none;">Mô tả</th>
                                        <th style="border: none;">Mức phí phải nộp (VNĐ)</th>
                                        <th style="border: none;">Đóng góp tối thiểu (VNĐ)</th>
                                        <th class="text-center" style="border: none;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tiers as $index => $tier)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ ($tiers->currentPage() - 1) * $tiers->perPage() + $index + 1 }}</td>
                                            <td>{{ $tier->name }}</td>
                                            <td>{{ $tier->description }}</td>
                                            <td>{{ number_format($tier->fee, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ number_format($tier->minimum_contribution, 0, ',', '.') }} VNĐ</td>
                                            <td class="text-center">
                                                <a href="{{ route('membership_tier.show', $tier->id) }}"
                                                    style="cursor: pointer">
                                                    <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $tiers->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
        </div>
    </div>
</x-app-layout>
