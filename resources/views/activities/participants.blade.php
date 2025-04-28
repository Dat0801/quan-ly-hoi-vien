<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách khách hàng tham gia hoạt động
            </h1>

            <div class="d-flex justify-content-center align-items-center mb-4">
                <div class="d-flex justify-content-center align-items-center p-3 border rounded shadow-sm" style="flex: 1; max-width: 300px; margin-right: 10px;">
                    <div>
                        <div class="text-center" style="font-size: 14px; color: #BF5805; font-weight: 600;">
                            Tổng Số Khách Hàng
                        </div>
                        <div class="fs-4 text-center" style="font-weight: 700; color: #803B03;">
                            {{ number_format($totalCustomers, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            
                <div class="d-flex justify-content-center align-items-center p-3 border rounded shadow-sm" style="flex: 1; max-width: 300px; margin-right: 10px;">
                    <div>
                        <div class="text-center" style="font-size: 14px; color: #BF5805; font-weight: 600;">
                            Số Lượng Khách Hàng Tham Gia
                        </div>
                        <div class="fs-4 text-center" style="font-weight: 700; color: #803B03;">
                            {{ number_format($participatingCustomers, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            
                <div class="d-flex justify-content-center align-items-center p-3 border rounded shadow-sm" style="flex: 1; max-width: 300px;">
                    <div>
                        <div class="text-center" style="font-size: 14px; color: #BF5805; font-weight: 600;">
                            Số Lượng Khách Hàng Không Tham Gia
                        </div>
                        <div class="fs-4 text-center" style="font-weight: 700; color: #803B03;">
                            {{ number_format($nonParticipatingCustomers, 0, ',', '.') }}
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

                        <h1 style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 500; line-height: 18.75px; text-align: left; color: #BF5805;"
                            class="mb-1">
                            Lọc theo loại đối tượng
                        </h1>

                        <div class="d-flex justify-content-between align-items-center">
                            <form id="customerSearchForm" method="GET"
                                action="{{ route('activity.participants', $activity->id) }}" class="d-flex mb-3">
                                <div class="d-flex align-items-center">
                                    <select name="participant_type" class="form-control" style="max-width: 200px;">
                                        <option value="">Tất cả</option>
                                        @foreach ($participantTypes as $type => $label)
                                            <option value="{{ $type }}"
                                                {{ request('participant_type') == $type ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <x-primary-button :height="38" :width="50" class="ms-3">
                                        Lọc
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table mt-3 table-sm w-100">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th class="text-center" style="border: none;">STT</th>
                                        <th style="border: none;">Mã Khách Hàng</th>
                                        <th style="border: none;">Tên Khách Hàng</th>
                                        <th style="border: none;">Email</th>
                                        <th style="border: none;">Trạng Thái Tham Gia</th>
                                        <th style="border: none;">Thời Gian Tham Gia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($participantDetails as $index => $participant)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $participant['login_code'] }}</td>
                                            <td>{{ $participant['name'] }}</td>
                                            <td>{{ $participant['email'] }}</td>
                                            <td>
                                                @if (now() < $activity->start_time)
                                                    <span class="badge bg-warning">Chưa bắt đầu</span>
                                                @else
                                                    <span class="badge bg-success">Tham gia</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (now() >= $activity->start_time)
                                                    {{ $activity->start_time }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="d-flex justify-content-center">
                                {{ $participantDetails->links('pagination::bootstrap-5') }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
