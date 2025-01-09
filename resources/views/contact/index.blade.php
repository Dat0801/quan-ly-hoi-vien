<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Liên hệ
            </h1>

            <div class="bg-white sm:rounded-lg">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="" style="margin-left: 20%; margin-right: 20%">
                    <div class="d-flex align-items-center mb-3">
                        <label for="hotline" class="form-label mb-0 me-3" style="width: 150px;">Hotline</label>
                        <input type="text" id="hotline" name="hotline" 
                            class="form-control border-gray-300 shadow-sm flex-grow-1" 
                            value="{{ $contact->hotline }}" disabled>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="website" class="form-label mb-0 me-3" style="width: 150px;">Website</label>
                        <input type="url" id="website" name="website" 
                            class="form-control border-gray-300 shadow-sm flex-grow-1" 
                            value="{{ $contact->website }}" disabled>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="fanpage" class="form-label mb-0 me-3" style="width: 150px;">Fanpage</label>
                        <input type="url" id="fanpage" name="fanpage" 
                            class="form-control border-gray-300 shadow-sm flex-grow-1" 
                            value="{{ $contact->fanpage }}" disabled>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="email" class="form-label mb-0 me-3" style="width: 150px;">Email</label>
                        <input type="email" id="email" name="email" 
                            class="form-control border-gray-300 shadow-sm flex-grow-1" 
                            value="{{ $contact->email }}" disabled>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label for="address" class="form-label mb-0 me-3" style="width: 150px;">Địa chỉ</label>
                        <input type="text" id="address" name="address" 
                            class="form-control border-gray-300 shadow-sm flex-grow-1" 
                            value="{{ $contact->address }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg" id="addNewButtonContainer">
            <a href="{{ route('contact.edit') }}"
                class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 p-3"
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;"
                id="addSponsorshipButton">
                <i class="fas fa-edit fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Chỉnh sửa</span>
            </a>
        </div>
    </div>
</x-app-layout>
