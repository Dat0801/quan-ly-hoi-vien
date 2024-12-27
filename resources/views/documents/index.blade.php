<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1;">
            <h1 style="
                    font-family: 'Roboto', sans-serif;
                    font-size: 32px;
                    font-weight: 700;
                    line-height: 38.4px;
                    text-align: left;
                    text-underline-position: from-font;
                    text-decoration-skip-ink: none;
                    color: #803B03;"
                class="mb-3"
                >Tài liệu lưu trữ</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1 style="
                    font-family: 'Roboto', sans-serif;
                    font-size: 16px;
                    font-weight: 500;
                    line-height: 18.75px;
                    text-align: left;
                    text-underline-position: from-font;
                    text-decoration-skip-ink: none;
                    color: #BF5805;"
                class="mb-1"
                >Định dạng</h1>

            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <form action="{{ route('dashboard') }}" method="GET" class="d-flex">
                        <select name="file_extension" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                            <option value="">Tất cả</option>
                            @foreach($fileExtensions as $extension)
                                <option value="{{ $extension }}" {{ request('file_extension') == $extension ? 'selected' : '' }}>
                                    {{ '.'.$extension }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="d-flex align-items-center">
                    <form action="{{ route('dashboard') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm...">
                            <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 table-sm w-100">
                    <thead style="background-color: #FFE3CD; color: #803B03;">
                        <tr>
                            <th class="text-center" style="border: none;">STT</th>
                            <th style="border: none;">Tên File</th>
                            <th style="border: none;">Định Dạng</th>
                            <th class="text-center" style="border: none;">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $index => $document)
                            <tr style="background-color: transparent;">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ \Illuminate\Support\Str::beforeLast($document->file_name, '.') }}</td> 
                                <td>{{ '.'.$document->file_extension }}</td>
                                <td class="text-center">
                                    <a href="{{ route('documents.download', $document->id) }}" class="btn-sm me-1" style="color: #FF7506">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;" id="deleteDocumentForm-{{ $document->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-sm text-danger"
                                                onclick="showModal('Bạn có muốn xóa file lưu trữ này?', function() { submitDocumentForm('{{ $document->id }}'); }, function() { })">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg">
            <a href="#" id="addFileButton" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm file mới</span>
            </a>

            <form id="uploadForm" action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" name="document" id="fileInput" class="form-control" required onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <script>
        document.getElementById('addFileButton').addEventListener('click', function(event) {
            event.preventDefault(); 
            document.getElementById('fileInput').click();
        });
    </script>
</x-app-layout>
