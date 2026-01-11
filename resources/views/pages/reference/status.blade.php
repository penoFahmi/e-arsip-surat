@extends('layout.main')

@push('script')
    <script>
        // Script Javascript untuk Modal Edit (Tetap dipertahankan)
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('reference.status.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#status').val($(this).data('status'));
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb :values="[__('menu.reference.menu'), __('menu.reference.status')]">
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#createModal">
            <i class="bx bx-plus me-1"></i> {{ __('menu.general.create') }}
        </button>
    </x-breadcrumb>

    <div class="card mb-5">

        <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <h5 class="mb-0 text-uppercase text-muted small fw-bold">Daftar Status Surat</h5>

            <form action="{{ url()->current() }}" method="get" class="d-flex align-items-center">
                <div class="input-group input-group-merge" style="width: 250px;">
                    <span class="input-group-text border-0 ps-2"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 shadow-none"
                        placeholder="Cari status..."
                        aria-label="Cari..."
                    >
                </div>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">#</th> <th>{{ __('model.status.status') }}</th>
                        <th class="text-end">{{ __('menu.general.action') }}</th>
                    </tr>
                </thead>
                @if($data->count())
                    <tbody class="table-border-bottom-0">
                    @foreach($data as $status)
                        <tr class="align-middle">
                            <td><span class="fw-bold">#{{ $status->id }}</span></td>

                            <td>
                                <span class="badge bg-label-info text-dark text-uppercase px-3">
                                    {{ $status->status }}
                                </span>
                            </td>

                            <td class="text-end">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item btn-edit"
                                            data-id="{{ $status->id }}"
                                            data-status="{{ $status->status }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="bx bx-edit-alt me-1"></i> {{ __('menu.general.edit') }}
                                        </button>

                                        <form action="{{ route('reference.status.destroy', $status) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger btn-delete">
                                                <i class="bx bx-trash me-1"></i> {{ __('menu.general.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <i class="bx bx-label text-secondary mb-2" style="font-size: 3rem;"></i>
                                <p class="text-muted mb-0">{{ __('menu.general.empty') }}</p>
                            </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {!! $data->appends(['search' => request('search')])->links() !!}
    </div>

    <div class="modal fade" id="createModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered"> <form class="modal-content" method="post" action="{{ route('reference.status.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('menu.general.create') }} Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-input-form name="status" :label="__('model.status.status')" placeholder="Contoh: Segera / Rahasia"/>
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
        <div class="modal-dialog modal-dialog-centered"> <form class="modal-content" method="post" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('menu.general.edit') }} Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <x-input-form name="status" :label="__('model.status.status')"/>
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
