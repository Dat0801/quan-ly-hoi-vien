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
                Thêm hoạt động
            </h1>

            <form id="activityForm" action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-3">
                            <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Tên hoạt động <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="Nhập tên hoạt động"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="start_time" class="form-label mb-0 me-2" style="width: 250px;">Thời gian bắt đầu
                                <span class="text-danger">*</span></label>
                            <input type="datetime-local" id="start_time" name="start_time"
                                value="{{ old('start_time') }}"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="end_time" class="form-label mb-0 me-2" style="width: 250px;">Thời gian kết thúc
                                <span class="text-danger">*</span></label>
                            <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time') }}"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="location" class="form-label mb-0 me-2" style="width: 250px;">Địa điểm <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}"
                                placeholder="Nhập địa điểm"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="content" class="form-label mb-0 me-2" style="width: 250px;">Nội dung</label>
                            <textarea id="content" name="content" rows="3" placeholder="Nhập nội dung hoạt động"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">{{ old('content') }}</textarea>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="attachment" class="form-label mb-0 me-2" style="width: 250px;">Tệp đính
                                kèm</label>
                            <input type="file" id="attachment" name="attachment"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="participants" class="form-label">Đối tượng trong hệ thống</label>
                            <select id="participants" name="participants[]"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                multiple>
                                <option value="all">Tất cả</option>
                                @foreach ($participantTypes as $type => $label)
                                    <option value="{{ $type }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="p-2 mx-auto"
                                    style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                                    Người ngoài hệ thống
                                </h3>
                                <button type="button" class="btn btn-outline-primary"
                                    id="addExternalParticipantButton">
                                    Thêm người
                                </button>
                            </div>

                            <table class="table table-bordered" id="externalParticipantsTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">STT</th>
                                        <th>Họ và Tên</th>
                                        <th>Email</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <x-cancel-button :route="route('activity.index')">
                        Hủy
                    </x-cancel-button>
                    <x-primary-button>
                        Thêm
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    document.getElementById('addExternalParticipantButton').addEventListener('click', function() {
        const tableBody = document.querySelector('#externalParticipantsTable tbody');
        const row = document.createElement('tr');
        const rowCount = tableBody.rows.length + 1;

        row.innerHTML = `
            <td style="text-align: center">${rowCount}</td> <!-- Số thứ tự -->
            <td><input type="text" name="external_participants[${rowCount - 1}][name]" 
                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" placeholder="Họ và Tên"></td>
            <td><input type="email" name="external_participants[${rowCount - 1}][email]" 
                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" placeholder="Email"></td>
            <td><button type="button" class="btn btn-danger removeRowButton"><i class="fas fa-trash-alt"></i></button></td>
        `;
        tableBody.appendChild(row);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeRowButton')) {
            e.target.closest('tr').remove();
            const rows = document.querySelectorAll('#externalParticipantsTable tbody tr');
            rows.forEach((row, index) => {
                row.cells[0].textContent = index + 1;
                const nameInput = row.querySelector('input[name*="name"]');
                const emailInput = row.querySelector('input[name*="email"]');
                nameInput.name = `external_participants[${index}][name]`;
                emailInput.name = `external_participants[${index}][email]`;
            });
        }
    });
</script>
