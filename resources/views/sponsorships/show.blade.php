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
                Chi tiết tài trợ
            </h1>

            <form>
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Người tài trợ -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="sponsor" class="form-label mb-0 me-2" style="width: 250px;">
                                Người tài trợ
                            </label>
                            <input type="text" id="sponsor"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->sponsorable->full_name ?? ($sponsorship->sponsorable->business_name_vi ?? '-') }}"
                                disabled>
                        </div>

                        <!-- Mã khách hàng -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="customer_id" class="form-label mb-0 me-2" style="width: 250px;">Mã khách
                                hàng</label>
                            <input type="text" id="customer_id" name="customer_id"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->sponsorable->login_code }}" disabled>
                        </div>

                        <!-- Số điện thoại -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện
                                thoại</label>
                            <input type="text" id="phone" name="phone"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->sponsorable->phone }}" disabled>
                        </div>

                        <!-- Ngày tài trợ -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="sponsorship_date" class="form-label mb-0 me-2" style="width: 250px;">Ngày tài
                                trợ</label>
                            <input type="date" id="sponsorship_date" name="sponsorship_date"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->sponsorship_date }}" disabled>
                        </div>

                        <!-- Nội dung -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="content" class="form-label mb-0 me-2" style="width: 250px;">Nội dung</label>
                            <textarea id="content" name="content" rows="3"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>{{ $sponsorship->content }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Sản phẩm tài trợ -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="product" class="form-label mb-0 me-2" style="width: 250px;">Sản phẩm tài
                                trợ</label>
                            <input type="text" id="product" name="product"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->product }}" disabled>
                        </div>

                        <!-- Đơn vị -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="unit" class="form-label mb-0 me-2" style="width: 250px;">Đơn vị</label>
                            <input type="text" id="unit" name="unit"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->unit }}" disabled>
                        </div>

                        <!-- Đơn giá -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="unit_price" class="form-label mb-0 me-2" style="width: 250px;">Đơn giá
                                (VNĐ)</label>
                            <input type="number" id="unit_price" name="unit_price"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->unit_price }}" disabled>
                        </div>

                        <!-- Số lượng -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="quantity" class="form-label mb-0 me-2" style="width: 250px;">Số lượng</label>
                            <input type="number" id="quantity" name="quantity"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->quantity }}" disabled>
                        </div>

                        <!-- Thành tiền -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="total_amount" class="form-label mb-0 me-2" style="width: 250px;">Thành tiền
                                (VNĐ)</label>
                            <input type="number" id="total_amount" name="total_amount"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                value="{{ $sponsorship->total_amount }}" disabled>
                        </div>

                        <!-- Đính kèm -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="attachment" class="form-label mb-0 me-2" style="width: 250px;">Tệp đính
                                kèm</label>
                            @if ($sponsorship->attachment)
                                <a href="{{ asset('storage/' . $sponsorship->attachment) }}" target="_blank"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">Xem
                                    tệp
                                    đính kèm</a>
                            @else
                                <input type="text" value="Không có tệp đính kèm"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <x-cancel-button :route="route('sponsorship.index')">
                        Đóng
                    </x-cancel-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
