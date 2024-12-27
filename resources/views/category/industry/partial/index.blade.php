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
        >Tìm kiếm</h1>
                
        <div class="d-flex align-items-center">
            <form id="industrySearchForm" method="GET">
                <input type="hidden" name="tab" value="{{ request('tab', 'industry') }}"> 
                <div class="input-group">
                    <input type="text" class="form-control" name="search_industry" value="{{ request('search_industry') }}" placeholder="Tìm kiếm ngành...">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        
        
        <div class="table-responsive">
            @if ($industries->isNotEmpty())
            <table class="table mt-3 table-sm w-100">
                <thead style="background-color: #FFE3CD; color: #803B03;">
                    <tr>
                        <th class="text-center" style="border: none;">STT</th>
                        <th style="border: none;">Mã ngành</th>
                        <th style="border: none;">Tên ngành</th>
                        <th style="border: none;">Mô tả</th>
                        <th class="text-center" style="border: none;">Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($industries as $index => $industry)
                        <tr style="background-color: transparent;">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $industry->industry_code }}</td>
                            <td>{{ $industry->industry_name }}</td>
                            <td>{{ $industry->description ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('industry.show', $industry->id) }}" class="me-1" style="cursor: pointer">
                                    <i class="fas fa-circle-info" style="color: #FF7506"></i>
                                </a>
                                <form action="{{ route('industry.destroy', $industry->id) }}" method="POST" style="display:inline;" id="deleteIndustryForm-{{ $industry->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-sm text-danger"
                                            onclick="showModal('Bạn có chắc chắn muốn xóa ngành này?', function() { submitIndustryForm('{{ $industry->id }}'); }, function() { })">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $industries->links('pagination::bootstrap-5')}}
            </div>
            @else
                <p>Không tìm thấy kết quả phù hợp.</p>
            @endif
        </div>
    </div>
</div>
