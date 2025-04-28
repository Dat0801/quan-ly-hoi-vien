<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách tài trợ
            </h1>

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="sponsorships-list" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h1 style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 500; line-height: 18.75px; text-align: left; color: #BF5805;"
                            class="mb-1">
                            Ngày tài trợ
                        </h1>

                        <div class="d-flex justify-content-between align-items-center">
                            <form id="sponsorshipSearchForm" method="GET" action="{{ route('sponsorship.index') }}"
                                class="d-flex mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="{{ request('start_date') }}" style="max-width: 200px;">

                                    <i class="fas fa-arrow-right mx-2 text-secondary"></i>

                                    <input type="date" id="end_date" name="end_date" class="form-control me-3"
                                        value="{{ request('end_date') }}" style="max-width: 200px;">

                                    <x-primary-button :height="42">
                                        Lọc
                                    </x-primary-button>
                                </div>
                            </form>

                            <form id="sponsorshipSearchForm" method="GET" action="{{ route('sponsorship.index') }}"
                                class="d-flex mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm tài trợ...">
                                    <button class="btn btn-outline-secondary" type="submit"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="">
                            <table class="table mt-3 table-sm w-100">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th class="text-center" style="border: none;">STT</th>
                                        <th style="border: none;">Tên khách hàng</th>
                                        <th style="border: none;">Sản phẩm tài trợ</th>
                                        <th style="border: none;">Đơn vị</th>
                                        <th style="border: none;">Số lượng</th>
                                        <th style="border: none;">Thành tiền (VNĐ)</th>
                                        <th style="border: none;">Ngày tài trợ</th>
                                        <th class="text-center" style="border: none;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sponsorships as $index => $sponsorship)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                {{ $sponsorship->sponsorable->full_name ?? $sponsorship->sponsorable->business_name_vi ?? '-' }}
                                            </td>
                                            <td>{{ $sponsorship->product ?? '-' }}</td>
                                            <td>{{ $sponsorship->unit ?? '-' }}</td>
                                            <td>{{ $sponsorship->quantity ?? '-' }}</td>
                                            <td>{{ number_format($sponsorship->total_amount, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $sponsorship->sponsorship_date }}
                                            <td class="text-center">
                                                <a href="{{ route('sponsorship.show', $sponsorship->id) }}"
                                                    class="me-1" style="cursor: pointer">
                                                    <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                                </a>

                                                <form action="{{ route('sponsorship.destroy', $sponsorship->id) }}"
                                                    method="POST" style="display:inline;"
                                                    id="deleteSponsorshipForm-{{ $sponsorship->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-sm text-danger"
                                                        onclick="showModal('Bạn có chắc chắn muốn xóa tài trợ này?', function() { submitSponsorshipForm('{{ $sponsorship->id }}'); }, function() { })">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $sponsorships->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('sponsorship.create') }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;"
                id="addSponsorshipButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm mới</span>
            </a>
        </div>
    </div>
</x-app-layout>
