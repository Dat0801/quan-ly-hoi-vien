<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1;">
            <h1 id="dynamicTitle" style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;" class="mb-3">
                Danh sách ngành
            </h1>

            @include('category.navigation')

            <div class="tab-content" id="managementTabsContent">
                <div class="tab-pane fade show active" id="industry" role="tabpanel" aria-labelledby="industry-tab">
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
                                <form id="industrySearchForm" method="GET" action="{{ route('industry.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm ngành...">
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
                </div>
            </div>

        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('industry.create') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3" style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" id="addIndustryButton">
                <i class="fas fa-plus fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Thêm ngành</span>
            </a>
        </div>
    </div>
</x-app-layout>

