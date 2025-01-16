<x-app-layout>
    <div class="d-flex align-items-start" style="margin-right: 20px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;"
                class="mb-3">
                Chi Tiết Lịch Họp
            </h1>

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center mb-3">
                        <label for="title" class="form-label mb-0 me-2"
                            style="width: 150px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Tiêu
                            đề:</label>
                        <span class="form-control-plaintext">{{ $notification->title }}</span>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="d-flex align-items-center mb-3">
                        <label for="format" class="form-label mb-0 me-2"
                            style="width: 150px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Hình
                            thức:</label>
                        <span
                            class="form-control-plaintext">{{ $notification->format === 'email' ? 'Email' : 'Notification' }}</span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex align-items-center mb-3">
                        <label for="send_time_option" class="form-label mb-0 me-2"
                            style="width: 150px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Thời
                            gian
                            gửi:</label>
                        <span class="form-control-plaintext">
                            {{ $notification->sent_at }}
                        </span>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="d-flex mb-3">
                        <label for="content" class="form-label mb-0 me-2"
                            style="width: 150px; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">Nội
                            dung:</label>
                        <span class="form-control-plaintext">{{ $notification->content }}</span>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div>
                        <div class="d-flex justify-content-start">
                            <h3
                                style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                                Người nhận
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
                                    @foreach ($notification->recipients as $index => $recipient)
                                        @if ($recipient->recipientable)
                                            <tr>
                                                <td style="text-align: center">{{ $index + 1 }}</td>
                                                <td>{{ $recipient->recipientable->login_code ?? '-' }}</td>
                                                <td>{{ $recipient->recipientable->full_name ?? ($recipient->recipientable->business_name_vi ?? '-') }}
                                                </td>
                                                <td>{{ $recipient->recipientable->email ?? '-' }}</td>
                                                <td>{{ $recipient->recipientable ? $participantTypes[get_class($recipient->recipientable)] : '-' }}
                                                </td>
                                                <td>{{ $recipient->recipientable->field->name ?? '-' }}</td>
                                                <td>{{ $recipient->recipientable->market->market_name ?? '-' }}</td>
                                                <td>{{ $recipient->recipientable->targetCustomerGroup->group_name ?? '-' }}
                                                </td>
                                                <td>{{ $recipient->recipientable->business_scale ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-warning">
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

                                    @foreach ($externalParticipants as $index => $recipient)
                                        <tr>
                                            <td style="text-align: center">Khác</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $recipient->email ?? '-' }}</td>
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
                <a href="{{ route('notification.index') }}"
                    class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
            </div>
        </div>
    </div>
</x-app-layout>
