<x-app-layout>
    <div class="d-flex align-items-start" style="margin-right: 20px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;"
                class="mb-3">
                Tạo thông báo mới
            </h1>

            <form id="meetingForm" action="{{ route('notification.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center mb-3">
                            <label for="title" class="form-label mb-0 me-2" style="width: 150px;">Tiêu đề <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                placeholder="Nhập tiêu đề thông báo"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center mb-3">
                                <label for="format" class="form-label mb-0 me-2" style="width: 140px;">Hình thức <span
                                        class="text-danger">*</span></label>
                                <div class="flex-grow-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="format_email" name="format" value="email"
                                            {{ old('format') === 'email' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="format_email">Email</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="format_notification" name="format"
                                            value="notification" {{ old('format') === 'notification' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="format_notification">Notification</label>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-lg-4 d-flex align-items-center mb-3">
                                <label for="send_time_option" class="form-label mb-0 me-2" style="width: 140px;">Thời gian gửi <span
                                        class="text-danger">*</span></label>
                                <div class="flex-grow-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="send_time_immediate" name="send_time_option"
                                            value="immediate" checked>
                                        <label class="form-check-label" for="send_time_immediate">Gửi ngay lập tức</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="send_time_custom" name="send_time_option"
                                            value="custom">
                                        <label class="form-check-label" for="send_time_custom">Tùy chọn thời gian</label>
                                    </div>
                                    <input type="datetime-local" id="custom_send_time" name="send_time"
                                        value="{{ old('send_time') }}" class="form-control border-gray-300 shadow-sm mt-2"
                                        style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex mb-3">
                            <label for="content" class="form-label mb-0 me-2" style="width: 150px;">Nội dung <span
                                    class="text-danger">*</span></label>
                            <textarea id="content" name="content" rows="5" placeholder="Nhập nội dung thông báo"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <div class="d-flex justify-content-start align-items-center">
                                <h3
                                    style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                                    Người nhận
                                </h3>
                            </div>

                            <div>
                                <div class="d-flex justify-content-start flex-wrap">
                                    <div class="me-2">
                                        <label for="filterType" class="form-label"
                                            style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: bold;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;">Loại
                                            thành viên</label>
                                        <select id="filterType" class="form-select">
                                            <option value="">Tất cả</option>
                                            @foreach ($participantTypes as $key => $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-2">
                                        <label for="filterField" class="form-label"
                                            style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: bold;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;">Lĩnh
                                            vực</label>
                                        <select id="filterField" class="form-select">
                                            <option value="">Tất cả</option>
                                            @foreach ($fields as $field)
                                                <option value="{{ $field->id }}">{{ $field->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-2">
                                        <label for="filterMarket" class="form-label"
                                            style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: bold;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;">Thị
                                            trường</label>
                                        <select id="filterMarket" class="form-select">
                                            <option value="">Tất cả</option>
                                            @foreach ($markets as $market)
                                                <option value="{{ $market->id }}">{{ $market->market_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-2">
                                        <label for="filterTargetCustomerGroup" class="form-label"
                                            style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: bold;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;">Khách
                                            hàng mục
                                            tiêu</label>
                                        <select id="filterTargetCustomerGroup" class="form-select">
                                            <option value="">Tất cả</option>
                                            @foreach ($targetCustomerGroups as $group)
                                                @if ($group != '-')
                                                    <option value="{{ $group }}">{{ $group }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-">
                                        <label for="filterBusinessScale" class="form-label"
                                            style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: bold;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;">Quy
                                            mô</label>
                                        <select id="filterBusinessScale" class="form-select">
                                            <option value="">Tất cả</option>
                                            @foreach ($businessScales as $scale)
                                                @if ($scale != '-')
                                                    <option value="{{ $scale }}">{{ $scale }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="ms-auto">
                                        <label for="searchParticipants" class="form-label"
                                            style="
                                        font-family: 'Roboto', sans-serif;
                                        font-size: 16px;
                                        font-weight: bold;
                                        line-height: 18.75px;
                                        text-align: left;
                                        color: #BF5805;">Tìm
                                            kiếm</label>
                                        <input type="text" id="searchParticipants" class="form-control"
                                            placeholder="Tìm kiếm người tham dự">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <table class="table mt-3 table-sm w-100" id="memberListTable">
                                    <thead style="background-color: #FFE3CD; color: #803B03;">
                                        <tr>
                                            <th style="text-align: center;">
                                                <input type="checkbox" id="selectAllMembers">
                                            </th>
                                            <th style="text-align: center">STT</th>
                                            <th>Mã khách hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Email</th>
                                            <th>Loại thành viên</th>
                                            <th>Lĩnh vực</th>
                                            <th>Thị trường</th>
                                            <th>Khách hàng mục tiêu</th>
                                            <th>Quy mô</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allParticipants as $index => $participant)
                                            <tr data-type="{{ $participant->type_name }}"
                                                data-field="{{ $participant->field->id ?? '' }}"
                                                data-market="{{ $participant->market->id ?? '' }}"
                                                data-customer-group="{{ $participant->target_customer_group ?? '' }}"
                                                data-business-scale="{{ $participant->business_scale ?? '' }}">
                                                <td style="text-align: center">
                                                    <input type="checkbox"
                                                        name="selected_members[{{ $index }}][id]"
                                                        value="{{ $participant->id }}" class="form-check-input">
                                                    <input type="hidden"
                                                        name="selected_members[{{ $index }}][type]"
                                                        value="{{ $participant->type }}">
                                                </td>
                                                <td style="text-align: center">{{ $index + 1 }}</td>
                                                <td>{{ $participant->login_code ?? '-' }}</td>
                                                <td>{{ $participant->full_name ?? ($participant->business_name_vi ?? '-') }}
                                                </td>
                                                <td>{{ $participant->email ?? '-' }}</td>
                                                <td>{{ $participant->type_name }}</td>
                                                <td>{{ $participant->field->name ?? '-' }}</td>
                                                <td>{{ $participant->market->market_name ?? '-' }}</td>
                                                <td>{{ $participant->target_customer_group ?? '-' }}</td>
                                                <td>{{ $participant->business_scale ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="10"
                                                style="background-color: #FF7506; padding: 0; height: 5px;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-outline-primary"
                                id="addExternalParticipantButton">Thêm người</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('notification.index') }}"
                        class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                    <button type="submit" form="meetingForm"
                        class="btn btn-primary w-48 py-3 sm:rounded-lg">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
     document.addEventListener('DOMContentLoaded', function () {
        const sendTimeImmediate = document.getElementById('send_time_immediate');
        const sendTimeCustom = document.getElementById('send_time_custom');
        const customSendTimeInput = document.getElementById('custom_send_time');

        const toggleCustomSendTime = () => {
            customSendTimeInput.style.display = sendTimeCustom.checked ? 'block' : 'none';
        };

        sendTimeImmediate.addEventListener('change', toggleCustomSendTime);
        sendTimeCustom.addEventListener('change', toggleCustomSendTime);

        toggleCustomSendTime();
    });

    document.getElementById('selectAllMembers').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('#memberListTable input[type="checkbox"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('filterType').addEventListener('change', filterMembers);
    document.getElementById('filterField').addEventListener('change', filterMembers);
    document.getElementById('filterMarket').addEventListener('change', filterMembers);
    document.getElementById('filterTargetCustomerGroup').addEventListener('change', filterMembers);
    document.getElementById('filterBusinessScale').addEventListener('change', filterMembers);
    document.getElementById('searchParticipants').addEventListener('input', filterMembers);

    function filterMembers() {
        const selectedType = document.getElementById('filterType').value.toLowerCase();
        const selectedField = document.getElementById('filterField').value.toLowerCase();
        const selectedMarket = document.getElementById('filterMarket').value.toLowerCase();
        const selectedCustomerGroup = document.getElementById('filterTargetCustomerGroup').value.toLowerCase();
        const selectedBusinessScale = document.getElementById('filterBusinessScale').value.toLowerCase();
        const searchQuery = document.getElementById('searchParticipants').value.toLowerCase();

        const rows = document.querySelectorAll('#memberListTable tbody tr');
        rows.forEach(row => {
            const type = row.getAttribute('data-type')?.toLowerCase() || '';
            const field = row.getAttribute('data-field')?.toLowerCase() || '';
            const market = row.getAttribute('data-market')?.toLowerCase() || '';
            const customerGroup = row.getAttribute('data-customer-group')?.toLowerCase() || '';
            const businessScale = row.getAttribute('data-business-scale')?.toLowerCase() || '';
            const name = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
            const email = row.querySelector('td:nth-child(5)').innerText.toLowerCase();

            const matchType = selectedType === '' || type.includes(selectedType);
            const matchField = selectedField === '' || field.includes(selectedField);
            const matchMarket = selectedMarket === '' || market.includes(selectedMarket);
            const matchCustomerGroup = selectedCustomerGroup === '' || customerGroup.includes(
                selectedCustomerGroup);
            const matchBusinessScale = selectedBusinessScale === '' || businessScale.includes(
                selectedBusinessScale);
            const matchSearch = name.includes(searchQuery) || email.includes(searchQuery);

            if (matchType && matchField && matchMarket && matchCustomerGroup && matchBusinessScale &&
                matchSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    document.getElementById('addExternalParticipantButton').addEventListener('click', function() {
        const tableBody = document.querySelector('#memberListTable tbody');
        const rowCount = tableBody.rows.length + 1;

        const row = document.createElement('tr');
        row.innerHTML = `
        <td style="text-align: center"><input type="checkbox" name="new_participants[${rowCount - 1}][selected]" class="form-check-input"></td>
        <td style="text-align: center">Khác</td>
        <td></td>
        <td></td>
        <td><input type="email" name="new_participants[${rowCount - 1}][email]" class="form-control" placeholder="Email" required></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    `;
        tableBody.appendChild(row);
    });

    document.getElementById('meetingForm').addEventListener('submit', function(e) {
        const checkboxes = document.querySelectorAll('#memberListTable input[type="checkbox"]:not(:checked)');
        checkboxes.forEach(checkbox => {
            checkbox.closest('tr').querySelectorAll('input[type="hidden"]').forEach(hiddenInput => {
                hiddenInput.disabled = true;
            });
        });
    });
</script>
