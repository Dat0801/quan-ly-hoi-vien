<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 24px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Danh sách cuộc họp
            </h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" action="{{ route('meeting.index') }}" class="d-flex align-items-center">
                    <div class="me-2">
                        <h1 style="
                                            font-family: 'Roboto', sans-serif;
                                            font-size: 16px;
                                            font-weight: bold;
                                            line-height: 18.75px;
                                            text-align: left;
                                            color: #BF5805;"
                            class="mb-1">
                            Tháng
                        </h1>
                        <select id="month" name="month" class="form-control" style="width: 150px;" onchange="this.form.submit()">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('month', now()->month) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="me-2">
                        <h1 style="
                                            font-family: 'Roboto', sans-serif;
                                            font-size: 16px;
                                            font-weight: bold;
                                            line-height: 18.75px;
                                            text-align: left;
                                            color: #BF5805;"
                            class="mb-1">
                            Năm
                        </h1>
                        <select id="year" name="year" class="form-control" style="width: 150px;"
                            onchange="this.form.submit()">
                            @for ($y = 2024; $y <= now()->year; $y++)
                                <option value="{{ $y }}"
                                    {{ request('year', now()->year) == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </form>
            </div>

            <div id="calendar-container" class="p-3" style="background-color: #f9f9f9; border-radius: 8px; max-height: 400px; overflow-y: auto;">
                <div id="calendar" style="max-width: 1020px;"></div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('meeting.create') }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addClubButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm mới</span>
            </a>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '{{ request('year', now()->year) }}-{{ str_pad(request('month', now()->month), 2, '0', STR_PAD_LEFT) }}-01',
                locale: 'vi',
                height: 'auto',
                contentHeight: 500,
                events: [
                    @foreach ($meetings as $meeting)
                        {
                            title: '{{ $meeting->title }}',
                            start: '{{ $meeting->start_time }}',
                            url: '{{ route('meeting.show', $meeting->id) }}',
                        },
                    @endforeach
                ],
                headerToolbar: {
                    left: 'title',
                    center: '',
                    right: 'prev,next'
                },
                buttonText: {
                    prev: '<',
                    next: '>',
                },
            });

            calendar.render();
        });
    </script>
</x-app-layout>
