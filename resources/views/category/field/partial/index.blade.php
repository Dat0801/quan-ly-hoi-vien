<div class="d-flex align-items-start">
    <!-- Main Content -->
    <div class="bg-white sm:rounded-lg" style="flex: 1;">
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
        >Danh sách Lĩnh Vực</h1>

        <div class="d-flex align-items-center">
            <form action="{{ route('field.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm lĩnh vực...">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table mt-3 table-sm w-100">
                <thead style="background-color: #FFE3CD; color: #803B03;">
                    <tr>
                        <th class="text-center" style="border: none;">STT</th>
                        <th style="border: none;">Mã lĩnh vực</th>
                        <th style="border: none;">Tên lĩnh vực</th>
                        <th style="border: none;">Mô tả</th>
                        <th style="border: none;">Ngành</th>
                        <th class="text-center" style="border: none;">Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fields as $index => $field)
                        <tr style="background-color: transparent;">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $field->code }}</td>
                            <td>{{ $field->name }}</td>
                            <td>{{ $field->description ?? '-' }}</td>
                            <td>{{ $field->industry->industry_name ?? '-' }}</td>
                            <td class="text-center">
                                <a href="" class="text-info me-1" style="cursor: pointer;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('field.destroy', $field->id) }}" method="POST" style="display:inline;" id="deleteFieldForm-{{ $field->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-sm text-danger"
                                            onclick="showModal('Bạn có muốn xóa lĩnh vực này?', function() { submitFieldForm('{{ $field->id }}'); }, function() { })">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $fields->links() }}
            </div>
        </div>
    </div>
</div>
