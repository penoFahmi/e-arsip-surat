@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('menu.transaction.menu'), __('menu.transaction.incoming_letter'), __('menu.general.edit')]">
        <a href="{{ route('transaction.incoming.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> {{ __('menu.general.cancel') }}
        </a>
    </x-breadcrumb>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Edit Surat Masuk</h5>
            <small class="text-muted">Perbarui data surat masuk yang telah direkam.</small>
        </div>

        <form action="{{ route('transaction.incoming.update', $data) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $data->id }}">
            <input type="hidden" name="type" value="{{ $data->type }}">

            <div class="card-body">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-hash me-1"></i> Identitas Surat</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <x-input-form :value="$data->reference_number" name="reference_number" :label="__('model.letter.reference_number')"/>
                    </div>
                    <div class="col-md-4">
                        <x-input-form :value="$data->agenda_number" name="agenda_number" :label="__('model.letter.agenda_number')"/>
                    </div>

                    <div class="col-md-4">
                        <label for="classification_code" class="form-label fw-bold text-uppercase text-muted small">
                            {{ __('model.letter.classification_code') }}
                        </label>
                        <div class="input-group input-group-merge">
                            <select class="form-select @error('classification_code') is-invalid @enderror" id="classification_code" name="classification_code">
                                <option value="" disabled>Pilih Klasifikasi</option>
                                @foreach($classifications as $classification)
                                    <option
                                        value="{{ $classification->code }}"
                                        @selected(old('classification_code', $data->classification_code) == $classification->code)>
                                        {{ $classification->code }} - {{ $classification->type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-envelope me-1"></i> Asal & Waktu Surat</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-input-form :value="$data->from" name="from" :label="__('model.letter.from')" placeholder="Pengirim surat..."/>
                    </div>
                    <div class="col-md-3">
                        <x-input-form :value="date('Y-m-d', strtotime($data->letter_date))" name="letter_date" :label="__('model.letter.letter_date')" type="date"/>
                    </div>
                    <div class="col-md-3">
                        <x-input-form :value="date('Y-m-d', strtotime($data->received_date))" name="received_date" :label="__('model.letter.received_date')" type="date"/>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-file me-1"></i> Isi Ringkas</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <x-input-textarea-form :value="$data->description" name="description" :label="__('model.letter.description')"/>
                    </div>
                    <div class="col-12">
                        <x-input-form :value="$data->note ?? ''" name="note" :label="__('model.letter.note')" placeholder="Catatan disposisi awal (Opsional)"/>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-primary mb-3"><i class="bx bx-paperclip me-1"></i> Lampiran Dokumen</h6>
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="attachments" class="form-label fw-bold text-uppercase text-muted small">{{ __('model.letter.attachment') }} (Tambah Baru)</label>
                            <input type="file" class="form-control @error('attachments') is-invalid @enderror" id="attachments" name="attachments[]" multiple/>
                            <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin menambah file baru.</small>
                        </div>
                    </div>

                    @if($data->attachments->count() > 0)
                    <div class="col-md-12">
                        <label class="form-label fw-bold text-uppercase text-muted small mb-2">File Saat Ini</label>
                        <div class="row g-2">
                            @foreach($data->attachments as $attachment)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-2 border rounded bg-light">
                                        <div class="d-flex align-items-center overflow-hidden">
                                            <i class="bx bx-file text-primary fs-4 me-2"></i>
                                            <a href="{{ $attachment->path_url }}" target="_blank" class="text-truncate fw-semibold" style="max-width: 200px;">
                                                {{ $attachment->filename }}
                                            </a>
                                        </div>
                                        <button type="button"
                                            class="btn btn-icon btn-sm btn-label-danger btn-remove-attachment"
                                            data-id="{{ $attachment->id }}"
                                            title="Hapus File Ini">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mt-4 pt-3 d-flex gap-2 justify-content-end border-top">
                    <a href="{{ route('transaction.incoming.index') }}" class="btn btn-outline-secondary">
                        {{ __('menu.general.cancel') }}
                    </a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bx bx-save me-1"></i> {{ __('menu.general.update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <form action="{{ route('attachment.destroy') }}" method="post" id="form-to-remove-attachment">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" id="attachment-id-to-remove">
    </form>
@endsection

@push('script')
    <script>
        $(document).on('click', '.btn-remove-attachment', function (req) {
            $('input#attachment-id-to-remove').val($(this).data('id'));
            Swal.fire({
                title: 'Hapus Lampiran?',
                text: "File ini akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff3e1d',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('form#form-to-remove-attachment').submit();
                }
            })
        });
    </script>
@endpush
