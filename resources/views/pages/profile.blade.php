@extends('layout.main')

@push('script')
    <script>
        // Logic untuk Checkbox Deaktivasi Akun
        $('input#accountActivation').on('change', function () {
            $('button.deactivate-account').attr('disabled', !$(this).is(':checked'));
        });

        // Logic Preview Gambar saat Upload
        document.addEventListener('DOMContentLoaded', function (e) {
            (function () {
                let accountUserImage = document.getElementById('uploadedAvatar');
                const fileInput = document.querySelector('.account-file-input'),
                    resetFileInput = document.querySelector('.account-image-reset');

                if (accountUserImage) {
                    const resetImage = accountUserImage.src;
                    fileInput.onchange = () => {
                        if (fileInput.files[0]) {
                            accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                        }
                    };
                    resetFileInput.onclick = () => {
                        fileInput.value = '';
                        accountUserImage.src = resetImage;
                    };
                }
            })();
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb :values="[__('navbar.profile.profile')]">
    </x-breadcrumb>

    <div class="row">
        <div class="col-md-12">

            @if(auth()->user()->role == 'admin')
                <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">
                            <i class="bx bx-user me-1"></i> {{ __('navbar.profile.profile') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('settings.show') }}">
                            <i class="bx bx-cog me-1"></i> {{ __('navbar.profile.settings') }}
                        </a>
                    </li>
                </ul>
            @endif

            <div class="card mb-4">
                <h5 class="card-header border-bottom mb-3">Detail Profil Pengguna</h5>

                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body pt-0">
                        <div class="d-flex align-items-center gap-4">
                            <img src="{{ $data->profile_picture }}" alt="user-avatar"
                                 class="d-block rounded-circle object-fit-cover" height="100" width="100" id="uploadedAvatar"
                                 style="border: 3px solid #e7e7e7;">

                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-2" tabindex="0">
                                    <i class="bx bx-upload me-1"></i>
                                    <span class="d-none d-sm-block">{{ __('menu.general.upload') }}</span>
                                    <input type="file" name="profile_picture" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                </label>

                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-2">
                                    <i class="bx bx-reset me-1"></i>
                                    <span class="d-none d-sm-block">{{ __('menu.general.cancel') }}</span>
                                </button>

                                <p class="text-muted mb-0 small">Format: JPG, GIF, PNG. Maksimal 800K.</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="card-body pt-1">
                        <div class="row g-3"> <input type="hidden" name="id" value="{{ $data->id }}">

                            <div class="col-md-6">
                                <x-input-form name="name" :label="__('model.user.name')" :value="$data->name" />
                            </div>

                            <div class="col-md-6">
                                <x-input-form name="email" :label="__('model.user.email')" :value="$data->email" />
                            </div>

                            <div class="col-md-6">
                                <x-input-form name="phone" :label="__('model.user.phone')" :value="$data->phone ?? ''" placeholder="08xxxxxxxx"/>
                            </div>
                        </div>

                        <div class="mt-4 pt-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> {{ __('menu.general.update') }}
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bx bx-refresh me-1"></i> {{ __('menu.general.cancel') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if(auth()->user()->role == 'staff')
                <div class="card border-danger mb-4">
                    <div class="card-header bg-danger text-white">
                        <i class="bx bx-error me-1"></i> {{ __('navbar.profile.deactivate_account') }}
                    </div>
                    <div class="card-body mt-3">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="bx bx-error-circle me-2 fs-4"></i>
                            <div>
                                <span class="fw-bold">{{ __('navbar.profile.deactivate_confirm_message') }}</span>
                            </div>
                        </div>

                        <form id="formAccountDeactivation" action="{{ route('profile.deactivate') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
                                <label class="form-check-label text-danger fw-bold" for="accountActivation">
                                    {{ __('navbar.profile.deactivate_confirm') }}
                                </label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account" disabled>
                                {{ __('navbar.profile.deactivate_account') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
