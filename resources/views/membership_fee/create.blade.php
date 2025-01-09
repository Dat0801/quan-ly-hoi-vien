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
                Thêm hội phí</h1>

            <form action="{{ route('membership_fee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-3">
                            <label for="member" class="form-label mb-0 me-2" style="width: 250px;">
                                Tên khách hàng <span class="text-danger">*</span>
                            </label>
                            <select id="member" name="member_id" class="form-control" required>
                                <option value="">-- Chọn khách hàng --</option>
                                @foreach ($allCustomers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('member_id') == $customer->id ? 'selected' : '' }}
                                        data-name="{{ $customer->full_name }}" data-phone="{{ $customer->phone }}"
                                        data-id="{{ $customer->id }}" data-type="{{ $customer->type }}">
                                        {{ $customer->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" id="customer_type_input" name="member_type" value="">

                        <div class="d-flex align-items-center mb-3">
                            <label for="customer_id" class="form-label mb-0 me-2" style="width: 250px;">Mã khách hàng
                                <span class="text-danger">*</span></label>
                            <input type="text" id="customer_id" name="customer_id" placeholder="Tự động"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required disabled>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="phone" name="phone" placeholder="Tự động"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required disabled>
                        </div>

                        <div class="mb-3">
                            <h4 class="h4-title">Hội phí</h4>
                        </div>

                        <div class="mb-3">
                            <div>
                                <input type="checkbox" id="debt_settlement_checkbox" name="debt_settlement"
                                    class="form-check-input me-2">
                                <label for="debt_settlement_checkbox" class="form-check-label">Tất toán nợ</label>
                            </div>
                            <div class="ms-2" id="debt_checkbox_container">
                                @foreach ($membershipFees as $fee)
                                    <div class="ms-4">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="debt[{{ $fee->year }}]"
                                                id="debt_{{ $fee->year }}"
                                                class="debt_checkbox form-check-input me-1"
                                                data-amount = "{{ $fee->amount_due }}"
                                                value="{{ $fee->year }}">
                                            Năm {{ $fee->year }}:
                                            {{ number_format($fee->amount_due, 0, ',', '.') }} VNĐ
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <label class="form-check-label me-3" style="width: 150px;">
                                <input type="checkbox" class="form-check-input me-2" id="advance_payment_checkbox"
                                    name="advance_payment_checkbox">
                                Đóng trước
                            </label>
                            <div class="ms-4 d-flex align-items-center" id="advance_years_section"
                                style="display: none;">
                                <label for="years_count" class="me-2">Chọn số năm:</label>
                                <input type="number" id="years_count" name="years_count" class="form-control me-2"
                                    placeholder="Số năm" min="1" style="width: 120px;">
                                <label for="advance_total_amount" class="me-2"> năm =</label>
                                <input type="text" id="advance_total_amount" name="advance_total_amount" disabled
                                    class="form-control" style="width: 150px;">
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="total_amount" class="form-label mb-0 me-2" style="width: 250px;">Tổng
                                tiền</label>
                            <input type="number" id="total_amount" name="total_amount" disabled
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                        </div>

                        <input type="hidden" id="hidden_total_amount" name="total_amount"
                            value="{{ old('total_amount') }}">


                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-3">
                            <label for="fee_date" class="form-label mb-0 me-2" style="width: 250px;">Ngày đóng hội
                                phí
                                <span class="text-danger">*</span></label>
                            <input type="date" id="fee_date" name="fee_date"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="content" class="form-label mb-0 me-2" style="width: 250px;">Nội dung</label>
                            <textarea id="content" name="content" rows="3" placeholder="Nhập nội dung hội phí" class="form-control">{{ old('content') }}</textarea>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="attachment" class="form-label mb-0 me-2" style="width: 250px;">Đính
                                kèm</label>
                            <input type="file" id="attachment" name="attachment" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('membership_fee.index') }}"
                        class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                    <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Thêm</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

<script>
    document.getElementById('member').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        if (selectedOption.value) {
            var name = selectedOption.getAttribute('data-name');
            var phone = selectedOption.getAttribute('data-phone');
            var id = selectedOption.getAttribute('data-id');
            var customerType = selectedOption.getAttribute('data-type');

            document.getElementById('customer_id').value = id;
            document.getElementById('phone').value = phone;

            document.getElementById('customer_type_input').value = customerType;
        } else {
            document.getElementById('customer_id').value = '';
            document.getElementById('phone').value = '';
            document.getElementById('customer_type_input').value = '';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const debtSettlementCheckbox = document.getElementById('debt_settlement_checkbox');
        const debtCheckboxContainer = document.getElementById('debt_checkbox_container');
        const debtCheckboxes = document.querySelectorAll('.debt_checkbox');
        const advancePaymentCheckbox = document.getElementById('advance_payment_checkbox');
        const advanceYearsSection = document.getElementById('advance_years_section');
        const yearsCountInput = document.getElementById('years_count');
        const advanceTotalAmountInput = document.getElementById('advance_total_amount');
        const totalAmountInput = document.getElementById('total_amount');
        const hiddenTotalAmountInput = document.getElementById('hidden_total_amount');

        function calculateTotalAmount() {
            let totalAmount = 0;

            debtCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    totalAmount += parseFloat(checkbox.dataset.amount);
                }
            });

            if (advancePaymentCheckbox.checked) {
                const years = parseInt(yearsCountInput.value, 10);
                const totalAdvance = isNaN(years) ? 0 : years * 1000000; 
                totalAmount += totalAdvance;
                advanceTotalAmountInput.value = totalAdvance.toLocaleString(); 
            } else {
                advanceTotalAmountInput.value = '';
            }

            totalAmountInput.value = totalAmount;
            hiddenTotalAmountInput.value = totalAmount; 
        }

        debtSettlementCheckbox.addEventListener('change', function() {
            const isChecked = debtSettlementCheckbox.checked;

            debtCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });

            calculateTotalAmount();
        });

        debtCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    debtSettlementCheckbox.checked = false;
                } else {
                    const allChecked = Array.from(debtCheckboxes).every(checkbox => checkbox
                        .checked);
                    debtSettlementCheckbox.checked = allChecked;
                }

                calculateTotalAmount();
            });
        });

        advancePaymentCheckbox.addEventListener('change', function() {
            if (advancePaymentCheckbox.checked) {
                advanceYearsSection.style.display = 'flex';
            } else {
                advanceYearsSection.style.display = 'none';
            }

            calculateTotalAmount();
        });

        yearsCountInput.addEventListener('input', function() {
            calculateTotalAmount();
        });

        calculateTotalAmount();
    });
</script>
