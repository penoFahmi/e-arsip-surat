@extends('layout.main')

@push('script')
    <script>
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            const form = $('#editModal form');

            // Update URL Action Form
            form.attr('action', '{{ route('user.index') }}/' + id);

            // Isi Value Input
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#name').val($(this).data('name'));
            $('#editModal input#phone').val($(this).data('phone'));
            $('#editModal input#email').val($(this).data('email'));

            // Handle Checkbox Active
            if ($(this).data('active') == 1) {
                $('#editModal input#is_active').prop('checked', true);
            } else {
                $('#editModal input#is_active').prop('checked', false);
            }

            // Reset checkbox password
            $('#editModal input#reset_password').prop('checked', false);
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb :values="[__('menu.users')]">
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#createModal">
            <i class="bx bx-plus me-1"></i> {{ __('menu.general.create') }}
        </button>
    </x-breadcrumb>

    <div class="card mb-5">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
            <h5 class="mb-0 text-uppercase text-muted small fw-bold">Daftar Pengguna</h5>

            <form action="{{ url()->current() }}" method="get" class="d-flex align-items-center">
                <div class="input-group input-group-merge">
                    <span class="input-group-text border-0 ps-2"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 shadow-none"
                        placeholder="Cari user..."
                        aria-label="Cari..."
                    >
                </div>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('model.user.name') }}</th>
                        <th>{{ __('model.user.email') }}</th>
                        <th>{{ __('model.user.phone') }}</th>
                        <th class="text-center">{{ __('model.user.is_active') }}</th>
                        <th class="text-center">{{ __('menu.general.action') }}</th>
                    </tr>
                </thead>
                @if($data->count())
                    <tbody class="table-border-bottom-0">
                    @foreach($data as $user)
                        <tr class="align-middle">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        @if($user->profile_picture)
                                            <img src="{{ $user->profile_picture }}" alt="Avatar" class="rounded-circle">
                                        @else
                                            <span class="avatar-initial rounded-circle bg-label-primary">{{ substr($user->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <span class="fw-bold text-dark">{{ $user->name }}</span>
                                </div>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>{{ $user->phone ?? '-' }}</td>

                            <td class="text-center">
                                @if($user->is_active)
                                    <span class="badge bg-label-success">Aktif</span>
                                @else
                                    <span class="badge bg-label-secondary">Non-Aktif</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-icon btn-sm btn-outline-warning btn-edit"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-active="{{ $user->is_active }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        title="Edit User">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>

                                    <form action="{{ route('user.destroy', $user) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-sm btn-outline-danger btn-delete" title="Hapus User">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-label-secondary rounded-circle" style="width: 80px; height: 80px;">
                                        <i class='bx bx-user-x text-secondary' style="font-size: 2.5rem;"></i>
                                    </div>
                                </div>
                                <h6 class="text-muted">Data pengguna tidak ditemukan.</h6>
                            </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $data->appends(['search' => request('search')])->links() !!}
    </div>

    <div class="modal fade" id="createModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" method="post" action="{{ route('user.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('menu.general.create') }} Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-input-form name="name" :label="__('model.user.name')" placeholder="Nama Lengkap"/>
                    <x-input-form name="email" :label="__('model.user.email')" type="email" placeholder="email@contoh.com"/>
                    <x-input-form name="phone" :label="__('model.user.phone')" placeholder="08xxxxxxxx"/>

                    <div class="alert alert-info d-flex align-items-center p-2 mt-3 mb-0" role="alert">
                        <i class="bx bx-info-circle me-2"></i>
                        <small>Password default adalah: <b>password</b></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" method="post" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('menu.general.edit') }} Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">

                    <x-input-form name="name" :label="__('model.user.name')"/>
                    <x-input-form name="email" :label="__('model.user.email')" type="email"/>
                    <x-input-form name="phone" :label="__('model.user.phone')"/>

                    <hr class="my-3">

                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="true" id="is_active">
                        <label class="form-check-label fw-bold" for="is_active">
                            {{ __('model.user.is_active') }} (Status Akun)
                        </label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="reset_password" value="true" id="reset_password">
                        <label class="form-check-label text-danger" for="reset_password">
                            {{ __('model.user.reset_password') }} (Set ke default)
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
