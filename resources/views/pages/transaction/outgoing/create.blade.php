@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('menu.transaction.menu'), __('menu.transaction.outgoing_letter'), __('menu.general.create')]">
        <a href="{{ route('transaction.outgoing.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> {{ __('menu.general.cancel') }}
        </a>
    </x-breadcrumb>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Buat Surat Keluar Baru</h5>
            <small class="text-muted">Isi formulir di bawah ini untuk merekam surat keluar.</small>
        </div>

        <form action="{{ route('transaction.outgoing.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="outgoing">

            <div class="card-body">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-hash me-1"></i> Identitas Surat</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <x-input-form name="reference_number" :label="__('model.letter.reference_number')" placeholder="Nomor Surat..."/>
                    </div>
                    <div class="col-md-4">
                        <x-input-form name="agenda_number" :label="__('model.letter.agenda_number')" placeholder="No. Agenda..."/>
                    </div>
                    <div class="col-md-4">
                        <x-input-form name="letter_date" :label="__('model.letter.letter_date')" type="date"/>
                    </div>

                    <div class="col-md-12">
                        <label for="classification_code" class="form-label fw-bold text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            {{ __('model.letter.classification_code') }}
                        </label>
                        <div class="input-group input-group-merge">
                            <select class="form-select @error('classification_code') is-invalid @enderror" id="classification_code" name="classification_code">
                                <option value="" disabled selected>Pilih Klasifikasi Surat</option>
                                @foreach($classifications as $classification)
                                    <option
                                        value="{{ $classification->code }}"
                                        @selected(old('classification_code') == $classification->code)>
                                        {{ $classification->code }} - {{ $classification->type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('classification_code')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-envelope me-1"></i> Isi Surat</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-form name="to" :label="__('model.letter.to')" placeholder="Tujuan Surat (Instansi/Perorangan)"/>
                    </div>
                    <div class="col-md-6">
                        <x-input-form name="note" :label="__('model.letter.note')" placeholder="Catatan tambahan (Opsional)"/>
                    </div>
                    <div class="col-12">
                        <x-input-textarea-form name="description" :label="__('model.letter.description')"/>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-paperclip me-1"></i> Lampiran Dokumen</h6>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="attachments" class="form-label fw-bold text-uppercase text-muted small">{{ __('model.letter.attachment') }}</label>
                            <input type="file" class="form-control @error('attachments') is-invalid @enderror" id="attachments" name="attachments[]" multiple />
                            <small class="text-muted d-block mt-1">Bisa upload banyak file sekaligus (PDF, JPG, PNG). Maksimal 2MB per file.</small>
                            <span class="error invalid-feedback">{{ $errors->first('attachments') }}</span>
                        </div>
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
