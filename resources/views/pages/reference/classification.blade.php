@extends('layout.main')

@push('script')
    <script>
        // Script ini tidak berubah, tetap berfungsi untuk modal Edit
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('reference.classification.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#code').val($(this).data('code'));
            $('#editModal input#type').val($(this).data('type'));
            $('#editModal input#description').val($(this).data('description'));
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb :values="[__('menu.reference.menu'), __('menu.reference.classification')]">
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
            <h5 class="mb-0 text-uppercase text-muted small fw-bold">Daftar Data Klasifikasi</h5>

            <form action="{{ url()->current() }}" method="get" class="d-flex align-items-center">
                <div class="input-group input-group-merge" style="width: 250px;">
                    <span class="input-group-text border-0 ps-2"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 shadow-none"
                        placeholder="Cari kode/tipe..."
                        aria-label="Cari..."
                    >
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('model.classification.code') }}</th>
                        <th>{{ __('model.classification.type') }}</th>
                        <th>{{ __('model.classification.description') }}</th>
                        <th class="text-end">{{ __('menu.general.action') }}</th>
                    </tr>
                </thead>
                @if($data->count())
                    <tbody class="table-border-bottom-0">
                    @foreach($data as $classification)
                        <tr class="align-middle">
                            <td>
                                <span class="fw-bold text-primary">#{{ $classification->code }}</span>
                            </td>
                            <td>
                                <span class="badge bg-label-secondary text-dark text-capitalize">
                                    {{ $classification->type }}
                                </span>
                            </td>
                            <td class="text-wrap" style="max-width: 300px;">
                                {{ $classification->description }}
                            </td>
                            <td class="text-end">
                                <button class="btn btn-info btn-sm btn-edit"
                                        data-id="{{ $classification->id }}"
                                        data-code="{{ $classification->code }}"
                                        data-type="{{ $classification->type }}"
                                        data-description="{{ $classification->description }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    {{ __('menu.general.edit') }}
                                </button>
                                <form action="{{ route('reference.classification.destroy', $classification) }}" class="d-inline" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-delete"
                                            type="button">{{ __('menu.general.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bx bx-data text-secondary mb-2" style="font-size: 3rem;"></i>
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
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" method="post" action="{{ route('reference.classification.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('menu.general.create') }} Klasifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-input-form name="code" :label="__('model.classification.code')" placeholder="Contoh: 001.1"/>
                    <x-input-form name="type" :label="__('model.classification.type')" placeholder="Contoh: Undangan Dinas"/>
                    <x-input-form name="description" :label="__('model.classification.description')" placeholder="Keterangan singkat..."/>
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
                    <h5 class="modal-title">{{ __('menu.general.edit') }} Klasifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <x-input-form name="code" :label="__('model.classification.code')"/>
                    <x-input-form name="type" :label="__('model.classification.type')"/>
                    <x-input-form name="description" :label="__('model.classification.description')"/>
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
