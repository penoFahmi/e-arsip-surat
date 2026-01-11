@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('menu.transaction.menu'), $letter->reference_number, __('menu.transaction.disposition_letter'), __('menu.general.create')]">
        <a href="{{ route('transaction.disposition.index', $letter) }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> {{ __('menu.general.cancel') }}
        </a>
    </x-breadcrumb>

    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <i class="bx bx-envelope me-2 fs-4"></i>
        <div>
            {{ __('model.disposition.notice_me', ['reference_number' => $letter->reference_number]) }}
            <a href="{{ route('transaction.incoming.show', $letter) }}" class="fw-bold text-decoration-underline ms-1">
                {{ __('menu.general.view') }} Detail Surat
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Tambah Disposisi Baru</h5>
            <small class="text-muted">Buat instruksi tindak lanjut untuk surat ini.</small>
        </div>

        <form action="{{ route('transaction.disposition.store', $letter) }}" method="POST">
            @csrf

            <div class="card-body">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-target-lock me-1"></i> Target & Status</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-form name="to" :label="__('model.disposition.to')" placeholder="Diteruskan kepada..."/>
                    </div>

                    <div class="col-md-3">
                        <x-input-form name="due_date" :label="__('model.disposition.due_date')" type="date"/>
                    </div>

                    <div class="col-md-3">
                        <label for="letter_status" class="form-label fw-bold text-uppercase text-muted small">
                            {{ __('model.disposition.status') }}
                        </label>
                        <div class="input-group input-group-merge">
                            <select class="form-select" id="letter_status" name="letter_status">
                                @foreach($statuses as $status)
                                    <option
                                        value="{{ $status->id }}"
                                        @selected(old('letter_status') == $status->id)>
                                        {{ $status->status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-message-detail me-1"></i> Instruksi & Catatan</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <x-input-textarea-form name="content" :label="__('model.disposition.content')" placeholder="Tuliskan isi perintah disposisi secara jelas..."/>
                    </div>
                    <div class="col-12">
                        <x-input-form name="note" :label="__('model.disposition.note')" placeholder="Catatan tambahan (Opsional)"/>
                    </div>
                </div>

                <div class="mt-4 pt-3 d-flex gap-2 justify-content-end border-top">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="bx bx-refresh me-1"></i> Reset
                    </button>
                    <button class="btn btn-primary" type="submit">
                        <i class="bx bx-save me-1"></i> {{ __('menu.general.save') }}
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection
