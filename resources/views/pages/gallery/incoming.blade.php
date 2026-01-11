@extends('layout.main')

@section('content')
    <x-breadcrumb
        :values="[__('menu.gallery.menu'), __('menu.gallery.incoming_letter')]">
    </x-breadcrumb>

    @if($data->count())
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4 mb-5">
            @foreach($data as $attachment)
                <div class="col">
                    <x-gallery-card
                        :filename="$attachment->filename"
                        :extension="$attachment->extension"
                        :path="$attachment->path_url"
                        :letter="$attachment->letter"
                    />
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {!! $data->appends(['search' => $search])->links() !!}
        </div>

    @else
        <div class="text-center py-5">
            <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center bg-label-secondary rounded-circle" style="width: 100px; height: 100px;">
                    <i class='bx bx-images text-secondary' style="font-size: 3rem;"></i>
                </div>
            </div>
            <h4 class="text-muted">Belum ada lampiran arsip</h4>
            <p class="text-muted mb-4">
                Lampiran yang diunggah pada surat masuk/keluar akan muncul di sini secara otomatis.
            </p>
        </div>
    @endif

@endsection
