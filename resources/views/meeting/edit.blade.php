<x-app-layout>
    <div class="d-flex align-items-start" style="margin-right: 20px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;"
                class="mb-3">
                Chỉnh sửa lịch họp
            </h1>
            <form action="{{ route('meeting.destroy', $meeting->id) }}" method="POST"
                class="d-flex justify-content-start mb-3" id="deleteMeetingForm-{{ $meeting->id }}">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger"
                    onclick="showModal('Bạn có chắc chắn muốn hủy lịch họp này?', function() { submitMeetingForm('{{ $meeting->id }}'); }, function() { })">
                    Hủy lịch
                </button>
            </form>
            <form id="meetingForm" action="{{ route('meeting.update', $meeting->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-3">
                            <label for="host" class="form-label mb-0 me-2" style="width: 250px;">Người chủ trì <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="host" name="host"
                                value="{{ old('host', $meeting->host) }}" placeholder="Nhập tên người chủ trì"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="title" class="form-label mb-0 me-2" style="width: 250px;">Tiêu đề cuộc họp
                                <span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title"
                                value="{{ old('title', $meeting->title) }}" placeholder="Nhập tiêu đề cuộc họp"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="content" class="form-label mb-0 me-2" style="width: 250px;">Nội dung cuộc
                                họp</label>
                            <textarea id="content" name="content" rows="3" placeholder="Nhập nội dung cuộc họp"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">{{ old('content', $meeting->content) }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-3">
                            <label for="location" class="form-label mb-0 me-2" style="width: 250px;">Địa điểm <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="location" name="location"
                                value="{{ old('location', $meeting->location) }}" placeholder="Nhập địa điểm"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="start_time" class="form-label mb-0 me-2" style="width: 250px;">Thời gian bắt đầu
                                <span class="text-danger">*</span></label>
                            @php
                                $formattedStartTime = $meeting->start_time
                                    ? \Carbon\Carbon::parse($meeting->start_time)->format('Y-m-d\TH:i')
                                    : '';
                            @endphp

                            <input type="datetime-local" id="start_time" name="start_time"
                                value="{{ old('start_time', $formattedStartTime) }}"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <div class="d-flex justify-content-start align-items-center">
                                <h3
                                    style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                                    Người tham dự
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
                                                        value="{{ $participant->id }}" class="form-check-input"
                                                        {{ in_array($participant->id, $meeting->participants->pluck('participantable_id')->toArray()) &&
                                                        in_array($participant->type, $meeting->participants->pluck('participantable_type')->toArray())
                                                            ? 'checked'
                                                            : '' }}>
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
                                        @foreach ($externalParticipants as $index => $participant)
                                            <tr>
                                                <td style="text-align: center">
                                                    <input type="checkbox"
                                                        name="external_participants[{{ $index }}][checked]"
                                                        value="1" class="form-check-input"
                                                        {{ $participant ? 'checked' : '' }}>
                                                </td>
                                                <td style="text-align: center">Khác</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <input type="email"
                                                        name="external_participants[{{ $index }}][email]"
                                                        value="{{ $participant->external_email ?? '' }}"
                                                        class="form-control" placeholder="Nhập email" required>
                                                </td>
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
                            <button type="button" class="btn btn-outline-primary"
                                id="addExternalParticipantButton">Thêm người</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <x-cancel-button :route="route('meeting.index')">
                        Hủy
                    </x-cancel-button>
                    <x-primary-button>
                        Lưu
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
<script>
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
        <td style="text-align: center"><input type="checkbox" name="external_participants[${rowCount - 1}][checked]" class="form-check-input"></td>
        <td style="text-align: center">Khác</td>
        <td></td>
        <td></td>
        <td><input type="email" name="external_participants[${rowCount - 1}][email]" class="form-control" placeholder="Email" required></td>
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
