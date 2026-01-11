@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('menu.transaction.menu'), __('menu.transaction.incoming_letter')]">
        <a href="{{ route('transaction.incoming.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> {{ __('menu.general.create') }}
        </a>
    </x-breadcrumb>

    @forelse($data as $letter)
        <x-letter-card :letter="$letter" />
    @empty
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-label-primary rounded-circle" style="width: 100px; height: 100px;">
                        <i class='bx bx-envelope text-primary' style="font-size: 3rem;"></i>
                    </div>
                </div>
                <h4 class="text-muted fw-bold">Belum ada Surat Masuk</h4>
                <p class="text-muted mb-4">
                    Arsip surat masuk yang Anda input akan tampil di sini.<br>
                    Silakan rekam surat masuk baru sekarang.
                </p>
                <a href="{{ route('transaction.incoming.create') }}" class="btn btn-outline-primary">
                    <i class="bx bx-plus me-1"></i> Buat Surat Masuk
                </a>
            </div>
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {!! $data->appends(['search' => $search])->links() !!}
    </div>

@endsection
