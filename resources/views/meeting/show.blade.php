<x-app-layout>
    <div class="d-flex align-items-start" style="margin-right: 20px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;"
                class="mb-3">
                Chi Tiết Lịch Họp
            </h1>

            <div class="row">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                        <label for="host" class="form-label mb-0 me-2"
                            style="width: 250px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Người
                            chủ trì:</label>
                        <span class="form-control-plaintext">{{ $meeting->host }}</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <label for="title" class="form-label mb-0 me-2"
                            style="width: 250px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Tiêu
                            đề cuộc
                            họp:</label>
                        <span class="form-control-plaintext">{{ $meeting->title }}</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <label for="content" class="form-label mb-0 me-2"
                            style="width: 250px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Nội
                            dung cuộc
                            họp:</label>
                        <span class="form-control-plaintext">{{ $meeting->content }}</span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                        <label for="location" class="form-label mb-0 me-2"
                            style="width: 250px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Địa
                            điểm:</label>
                        <span class="form-control-plaintext">{{ $meeting->location }}</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <label for="start_time" class="form-label mb-0 me-2"
                            style="width: 250px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Thời
                            gian bắt
                            đầu:</label>
                        <span class="form-control-plaintext">{{ $meeting->start_time }}</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <label for="status" class="form-label mb-0 me-2"
                            style="width: 250px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Trạng
                            thái:</label>
                        @php
                            $currentTime = now();
                            $status = '';
                            $statusClass = '';

                            if ($currentTime < $meeting->start_time) {
                                $status = 'Chưa diễn ra';
                                $statusClass = 'text-warning';
                            } elseif (
                                $currentTime >= $meeting->start_time &&
                                ($meeting->end_time ? $currentTime <= $meeting->end_time : true)
                            ) {
                                $status = 'Đang diễn ra';
                                $statusClass = 'text-success';
                            } elseif ($meeting->end_time && $currentTime > $meeting->end_time) {
                                $status = 'Đã kết thúc';
                                $statusClass = 'text-danger';
                            }
                        @endphp
                        <span class="form-control-plaintext {{ $statusClass }}" style="font-weight: bold">{{ $status }}</span>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div>
                        <div class="d-flex justify-content-start">
                            <h3
                                style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                                Người tham dự
                            </h3>
                        </div>

                        <div>
                            <table class="table table-sm w-100" id="memberListTable">
                                <thead style="background-color: #FFE3CD; color: #803B03;">
                                    <tr>
                                        <th style="text-align: center">STT</th>
                                        <th>Mã khách hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Email</th>
                                        <th>Loại thành viên</th>
                                        <th>Lĩnh vực</th>
                                        <th>Thị trường</th>
                                        <th>Khách hàng mục tiêu</th>
                                        <th>Quy mô</th>
                                        <th>Xác nhận tham gia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meeting->participants as $index => $participant)
                                        @if($participant->participantable)
                                            <tr>
                                                <td style="text-align: center">{{ $index + 1 }}</td>
                                                <td>{{ $participant->participantable->login_code ?? '-' }}</td>
                                                <td>{{ $participant->participantable->full_name ?? ($participant->participantable->business_name_vi ?? '-') }}
                                                </td>
                                                <td>{{ $participant->participantable->email ?? '-' }}</td>
                                                <td>{{ $participant->participantable ? $participantTypes[get_class($participant->participantable)] : '-' }}
                                                </td>
                                                <td>{{ $participant->participantable->field->name ?? '-' }}</td>
                                                <td>{{ $participant->participantable->market->market_name ?? '-' }}</td>
                                                <td>{{ $participant->participantable->targetCustomerGroup->group_name ?? '-' }}</td>
                                                <td>{{ $participant->participantable->business_scale ?? '-' }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-warning">
                                                        Chưa xác nhận
                                                    </span>

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="10" style="background-color: #FF7506; padding: 0; height: 5px;">
                                        </td>
                                    </tr>

                                    @foreach ($externalParticipants as $index => $participant)
                                        <tr>
                                            <td style="text-align: center">Khác</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $participant->external_email ?? '-' }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('meeting.index') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
                @if ($status !== 'Đang diễn ra')
                    <a href="{{ route('meeting.edit', $meeting->id) }}" class="btn btn-primary w-48 py-3 sm:rounded-lg">Chỉnh sửa</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
