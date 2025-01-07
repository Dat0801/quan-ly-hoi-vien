<x-app-layout>
    <div style="margin-right: 110px;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;"
                class="mb-3">
                Xem hoạt động
            </h1>

            <div class="row">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center mb-3">
                        <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Tên hoạt động</label>
                        <input type="text" id="name" name="name" value="{{ $activity->name }}"
                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="start_time" class="form-label mb-0 me-2" style="width: 250px;">Thời gian bắt
                            đầu</label>
                        <input type="datetime-local" id="start_time" name="start_time"
                            value="{{ $activity->start_time }}"
                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="end_time" class="form-label mb-0 me-2" style="width: 250px;">Thời gian kết
                            thúc</label>
                        <input type="datetime-local" id="end_time" name="end_time" value="{{ $activity->end_time }}"
                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="location" class="form-label mb-0 me-2" style="width: 250px;">Địa điểm</label>
                        <input type="text" id="location" name="location" value="{{ $activity->location }}"
                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="content" class="form-label mb-0 me-2" style="width: 250px;">Nội dung</label>
                        <textarea id="content" name="content" rows="3"
                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>{{ $activity->content }}</textarea>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="attachment" class="form-label mb-0 me-2" style="width: 250px;">Tệp đính kèm</label>
                        @if ($activity->attachment)
                            <a href="{{ asset('storage/' . $activity->attachment) }}" target="_blank"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">Xem tệp
                                đính kèm</a>
                        @else
                            <input type="text" value="Không có tệp đính kèm"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                disabled>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Đối tượng trong hệ thống</label>
                        <select class="form-control" multiple disabled>
                            @foreach ($participantTypes as $type => $label)
                                <option value="{{ $type }}"
                                    {{ $activity->participants && in_array($type, $activity->participants->pluck('participantable_type')->toArray() ?? []) ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('activities.participants', $activity->id) }}" class="btn btn-primary">
                        Danh sách đối tượng tham gia
                    </a>
                </div>

                <div class="col-lg-12">
                    <div class="mb-3">
                        <h3 class="p-2 mx-auto text-center"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            Người ngoài hệ thống
                        </h3>

                        <table class="table table-bordered" id="externalParticipantsTable">
                            <thead>
                                <tr>
                                    <th style="text-align: center">STT</th>
                                    <th>Họ và Tên</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $stt = 1; @endphp
                                @foreach ($externalParticipants as $participant)
                                    <tr>
                                        <td style="text-align: center">{{ $stt }}</td>
                                        <td>
                                            <input type="text" value="{{ $participant['name'] }}"
                                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                                disabled>
                                        </td>
                                        <td>
                                            <input type="email" value="{{ $participant['email'] }}"
                                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                                disabled>
                                        </td>
                                    </tr>
                                    @php $stt++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('activities.index') }}"
                    class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
            </div>
        </div>
    </div>
</x-app-layout>
