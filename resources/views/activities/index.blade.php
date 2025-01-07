<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách hoạt động
            </h1>

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="activities-list" role="tabpanel">
                    <div class="bg-white sm:rounded-lg">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h1 style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 500; line-height: 18.75px; text-align: left; color: #BF5805;"
                            class="mb-1">
                            Thời gian hoạt động
                        </h1>

                        <div class="d-flex justify-content-between align-items-center">
                            <form id="activitySearchForm" method="GET" action="{{ route('activities.index') }}"
                                class="d-flex mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="{{ request('start_date') }}" style="max-width: 200px;">

                                    <i class="fas fa-arrow-right mx-2 text-secondary"></i>

                                    <input type="date" id="end_date" name="end_date" class="form-control me-3"
                                        value="{{ request('end_date') }}" style="max-width: 200px;">

                                    <button type="submit" class="btn btn-primary">Lọc</button>
                                </div>
                            </form>

                            <form id="activitySearchForm" method="GET" action="{{ route('activities.index') }}"
                                class="d-flex mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        value="{{ request('search') }}" placeholder="Tìm kiếm hoạt động...">
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
                                        <th style="border: none;">Tên hoạt động</th>
                                        <th style="border: none;">Nội dung hoạt động</th>
                                        <th style="border: none;">Thời gian bắt đầu</th>
                                        <th style="border: none;">Thời gian kết thúc</th>
                                        <th style="border: none;">Trạng thái</th>
                                        <th class="text-center" style="border: none;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $index => $activity)
                                        <tr style="background-color: transparent;">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $activity->name }}</td>
                                            <td>{{ $activity->content }}</td>
                                            <td>{{ $activity->start_time }}</td>
                                            <td>{{ $activity->end_time }}</td>
                                            <td>
                                                @if (now() < $activity->start_time)
                                                    <span class="badge bg-warning">Chưa bắt đầu</span>
                                                @elseif (now() > $activity->end_time)
                                                    <span class="badge bg-secondary">Đã kết thúc</span>
                                                @else
                                                    <span class="badge bg-success">Đang diễn ra</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('activities.show', $activity->id) }}" class="me-1"
                                                    style="cursor: pointer">
                                                    <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                                </a>

                                                @if (now() < $activity->start_time)
                                                    <a href="{{ route('activities.edit', $activity->id) }}"
                                                        class="me-1" style="cursor: pointer">
                                                        <i class="fas fa-edit" style="color: #FF7506"></i>
                                                    </a>

                                                    <form action="{{ route('activities.destroy', $activity->id) }}"
                                                        method="POST" style="display:inline;"
                                                        id="deleteActivityForm-{{ $activity->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn-sm text-danger"
                                                            onclick="showModal('Bạn có chắc chắn muốn xóa hoạt động này?', function() { submitActivityForm('{{ $activity->id }}'); }, function() { })">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $activities->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('activities.create') }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addActivityButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm mới</span>
            </a>
        </div>
    </div>
</x-app-layout>
