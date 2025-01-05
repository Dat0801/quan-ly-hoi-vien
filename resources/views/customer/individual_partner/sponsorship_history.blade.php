<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Lịch sử tài trợ
            </h1>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center p-3 border rounded shadow-sm" style="max-width: 300px;">
                    <div class="me-3">
                        <i class="fa-solid fa-hand-holding-heart" style="font-size: 30px; color: #FF7506;"></i>
                    </div>
            
                    <div>
                        <div class="text" style="font-size: 14px; color: #BF5805; font-weight: 600;">
                            Tổng Đóng Góp
                        </div>
                        <div class="fs-4" style="font-weight: 700; color: #803B03;">
                            {{ number_format($totalContribution, 0, ',', '.') }} VNĐ
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="sponsorships-history" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h1 style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 500; line-height: 18.75px; text-align: left; color: #BF5805;" class="mb-1">
                            Ngày tài trợ
                        </h1>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <form id="sponsorshipSearchForm" method="GET" action="{{ route('individual_partner.sponsorship_history', $customer->id) }}" class="d-flex mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}" style="max-width: 200px;">
                        
                                    <i class="fas fa-arrow-right mx-2 text-secondary"></i>
                        
                                    <input type="date" id="end_date" name="end_date" class="form-control me-3" value="{{ request('end_date') }}" style="max-width: 200px;">
                        
                                    <button type="submit" class="btn btn-primary">Lọc</button>
                                </div>
                            </form>
                        
                            <form id="sponsorshipSearchForm" method="GET" action="{{ route('individual_partner.sponsorship_history', $customer->id) }}" class="d-flex mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm tài trợ...">
                                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table mt-3 table-sm w-100">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th class="text-center" style="border: none;">STT</th>
                                        <th style="border: none;">Ngày đóng góp</th>
                                        <th style="border: none;">Nội dung</th>
                                        <th style="border: none;">Sản phẩm đóng góp</th>
                                        <th style="border: none;">Đơn vị</th>
                                        <th style="border: none;">Số lượng</th>
                                        <th style="border: none;">Thành tiền (VNĐ)</th>
                                        <th style="border: none;">Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sponsorships as $index => $sponsorship)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($sponsorship->sponsorship_date)->format('d/m/Y') }}</td>
                                            <td>{{ $sponsorship->content ?? '-' }}</td>
                                            <td>{{ $sponsorship->product ?? '-' }}</td>
                                            <td>{{ $sponsorship->unit ?? '-' }}</td>
                                            <td>{{ $sponsorship->quantity ?? '-' }}</td>
                                            <td>{{ number_format($sponsorship->total_amount, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $sponsorship->attachment ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="d-flex justify-content-center">
                                {{ $sponsorships->links('pagination::bootstrap-5') }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
