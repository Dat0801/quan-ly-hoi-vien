<x-app-layout>
    <div class="d-flex align-items-start">
        <div class="p-4 sm:p-8 bg-white sm:rounded-lg" style="flex: 1">
            <h1 id="dynamicTitle"
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; color: #803B03;"
                class="mb-3">
                Chỉnh sửa liên hệ
            </h1>

            <div class="bg-white sm:rounded-lg">
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
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="" style="margin-left: 20%; margin-right: 20%">
                        <div class="d-flex align-items-center mb-3">
                            <label for="hotline" class="form-label mb-0 me-3" style="width: 150px;">Hotline</label>
                            <input type="text" id="hotline" name="hotline"
                                class="form-control border-gray-300 shadow-sm flex-grow-1"
                                value="{{ $contact->hotline }}" required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="website" class="form-label mb-0 me-3" style="width: 150px;">Website</label>
                            <input type="text" id="website" name="website"
                                class="form-control border-gray-300 shadow-sm flex-grow-1"
                                value="{{ $contact->website }}">
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="fanpage" class="form-label mb-0 me-3" style="width: 150px;">Fanpage</label>
                            <input type="text" id="fanpage" name="fanpage"
                                class="form-control border-gray-300 shadow-sm flex-grow-1"
                                value="{{ $contact->fanpage }}">
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="email" class="form-label mb-0 me-3" style="width: 150px;">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" value="{{ $contact->email }}"
                                required>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="address" class="form-label mb-0 me-3" style="width: 150px;">Địa chỉ</label>
                            <input type="text" id="address" name="address"
                                class="form-control border-gray-300 shadow-sm flex-grow-1"
                                value="{{ $contact->address }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <x-cancel-button :route="route('contact.index')">
                            Hủy
                        </x-cancel-button>
                        <x-primary-button>
                            Lưu
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
