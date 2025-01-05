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
                Thêm tài trợ</h1>

            <form action="{{ route('sponsorships.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-3">
                            <label for="sponsor" class="form-label mb-0 me-2" style="width: 250px;">
                                Người tài trợ <span class="text-danger">*</span>
                            </label>
                            <select id="sponsor" name="sponsorable_id" class="form-control" required>
                                <option value="">-- Chọn người tài trợ --</option>
                                @foreach ($allCustomers as $customer)
                                    <option value="{{ $customer->id }}" 
                                        {{ old('sponsorable_id') == $customer->id ? 'selected' : '' }} 
                                        data-name="{{ $customer->full_name }}" 
                                        data-phone="{{ $customer->phone }}" 
                                        data-id="{{ $customer->id }}" 
                                        data-type="{{ $customer->type }}">
                                        {{ $customer->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" id="customer_type_input" name="sponsorable_type" value="">

                        <div class="d-flex align-items-center mb-3">
                            <label for="customer_id" class="form-label mb-0 me-2" style="width: 250px;">Mã khách
                                hàng <span class="text-danger">*</span></label>
                            <input type="text" id="customer_id" name="customer_id" placeholder="Tự động"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required disabled>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện
                                thoại <span class="text-danger">*</span></label>
                            <input type="text" id="phone" name="phone" placeholder="Tự động"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required disabled>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="sponsorship_date" class="form-label mb-0 me-2" style="width: 250px;">Ngày
                                tài trợ <span class="text-danger">*</span></label>
                            <input type="date" id="sponsorship_date" name="sponsorship_date"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="content" class="form-label mb-0 me-2" style="width: 250px;">Nội
                                dung</label>
                            <textarea id="content" name="content" rows="3" placeholder="Nhập nội dung tài trợ" class="form-control">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-3">
                            <label for="product" class="form-label mb-0 me-2" style="width: 250px;">Sản
                                phẩm tài trợ
                                <span class="text-danger">*</span></label>
                            <input type="text" id="product" name="product" value="{{ old('product') }}"
                                placeholder="Nhập sản phẩm tài trợ"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                            @if ($errors->has('product'))
                                <span class="text-danger ms-2">{{ $errors->first('product') }}</span>
                            @endif
                        </div>
                        <!-- Đơn vị -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="unit" class="form-label mb-0 me-2" style="width: 250px;">Đơn vị <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="unit" name="unit" value="{{ old('unit') }}"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                placeholder="Nhập đơn vị" class="form-control" required>
                        </div>

                        <!-- Đơn giá -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="unit_price" class="form-label mb-0 me-2" style="width: 250px;">Đơn giá <span
                                    class="text-danger">*</span>
                                (VNĐ)</label>
                            <input type="number" id="unit_price" name="unit_price" value="{{ old('unit_price') }}"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                placeholder="Nhập đơn giá" class="form-control" required>
                        </div>

                        <!-- Số lượng -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="quantity" class="form-label mb-0 me-2" style="width: 250px;">Số
                                lượng <span class="text-danger">*</span></label>
                            <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                placeholder="Nhập số lượng" class="form-control" required>
                        </div>

                        <!-- Thành tiền -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="total_amount" class="form-label mb-0 me-2" style="width: 250px;">Thành tiền
                                (VNĐ)</label>
                            <input type="number" id="total_amount" name="total_amount"
                                value="{{ old('total_amount') }}" placeholder="Tự tính thành tiền" disabled
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                        </div>

                        <!-- Trường ẩn để gửi thành tiền -->
                        <input type="hidden" id="hidden_total_amount" name="total_amount"
                            value="{{ old('total_amount') }}">

                        <!-- Đính kèm -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="attachment" class="form-label mb-0 me-2" style="width: 250px;">Đính
                                kèm</label>
                            <input type="file" id="attachment" name="attachment" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('sponsorships.index') }}"
                        class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                    <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Thêm</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
<script>
    document.getElementById('sponsor').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        if (selectedOption.value) {
            var name = selectedOption.getAttribute('data-name');
            var phone = selectedOption.getAttribute('data-phone');
            var id = selectedOption.getAttribute('data-id');
            var customerType = selectedOption.getAttribute(
                'data-type'); 

            document.getElementById('customer_id').value = id;
            document.getElementById('phone').value = phone;

            document.getElementById('customer_type_input').value = customerType;
        } else {
            document.getElementById('customer_id').value = '';
            document.getElementById('phone').value = '';
            document.getElementById('customer_type_input').value = ''; 
        }
    });

    function calculateTotalAmount() {
        var unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
        var quantity = parseInt(document.getElementById('quantity').value) || 0;

        var totalAmount = unitPrice * quantity;

        document.getElementById('total_amount').value = totalAmount.toFixed(2); 
        document.getElementById('hidden_total_amount').value = totalAmount.toFixed(2); 
    }

    document.getElementById('unit_price').addEventListener('input', calculateTotalAmount);
    document.getElementById('quantity').addEventListener('input', calculateTotalAmount);
</script>
