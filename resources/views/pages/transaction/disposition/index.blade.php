@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('menu.transaction.menu'), $letter->reference_number, __('menu.transaction.disposition_letter')]">
        <div class="d-flex gap-2">
            <a href="{{ route('transaction.incoming.show', $letter) }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
            <a href="{{ route('transaction.disposition.create', $letter) }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> {{ __('menu.general.create') }}
            </a>
        </div>
    </x-breadcrumb>

    <div class="alert alert-primary alert-dismissible d-flex align-items-center" role="alert">
        <i class="bx bx-info-circle me-2 fs-4"></i>
        <div>
            {{ __('model.disposition.notice_me', ['reference_number' => $letter->reference_number]) }}
            <a href="{{ route('transaction.incoming.show', $letter) }}" class="fw-bold text-decoration-underline">
                {{ __('menu.general.view') }} Detail Surat
            </a>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @forelse($data as $disposition)
        <x-disposition-card
            :letter="$letter"
            :disposition="$disposition"
        />
    @empty
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-label-info rounded-circle" style="width: 100px; height: 100px;">
                        <i class='bx bx-task-x text-info' style="font-size: 3rem;"></i>
                    </div>
                </div>
                <h4 class="text-muted fw-bold">Belum ada Disposisi</h4>
                <p class="text-muted mb-4">
                    Surat ini belum memiliki instruksi disposisi kepada staf/bawahan.<br>
                    Klik tombol di bawah untuk menambahkan instruksi baru.
                </p>
                <a href="{{ route('transaction.disposition.create', $letter) }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Disposisi Sekarang
                </a>
            </div>
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {!! $data->appends(['search' => $search])->links() !!}
    </div>

@endsection
