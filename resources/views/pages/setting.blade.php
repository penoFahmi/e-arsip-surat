@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('navbar.profile.settings')]">
    </x-breadcrumb>

    <div class="row">
        <div class="col-md-12">

            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.show') }}">
                        <i class="bx bx-user me-1"></i> {{ __('navbar.profile.profile') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);">
                        <i class="bx bx-cog me-1"></i> {{ __('navbar.profile.settings') }}
                    </a>
                </li>
            </ul>

            <div class="card mb-4">

                <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Konfigurasi Umum Sistem</h5>
                    <small class="text-muted">Pengaturan ini akan mempengaruhi tampilan global aplikasi (kop surat, nama instansi, dll).</small>
                </div>

                <div class="card-body mt-4">
                    <form action="{{ route('settings.update') }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            @foreach($configs as $config)
                                @continue($config->code == 'language')

                                <div class="col-md-6">
                                    <x-input-form
                                        :name="$config->code"
                                        :value="$config->value ?? ''"
                                        :label="__('model.config.' . $config->code)"
                                    />
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> {{ __('menu.general.update') }}
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bx bx-refresh me-1"></i> {{ __('menu.general.cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
