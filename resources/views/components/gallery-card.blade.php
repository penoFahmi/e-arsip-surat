<style>
    .file-card {
        border: 1px solid #e6e8eb;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        overflow: hidden;
        height: 100%; /* Agar tinggi kartu seragam */
        background: #fff;
    }
    .file-card:hover {
        border-color: #0d47a1; /* Biru BKAD */
        transform: translateY(-4px);
        box-shadow: 0 5px 15px rgba(13, 71, 161, 0.1);
    }

    /* Area Preview (Atas) */
    .file-preview-area {
        height: 160px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    /* Jika file gambar, buat memenuhi kotak */
    .file-preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .file-card:hover .file-preview-img {
        transform: scale(1.05);
    }

    /* Badge Ekstensi (Pojok Kiri Atas) */
    .file-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-transform: uppercase;
        z-index: 2;
    }

    .badge-pdf { background: #ffebee; color: #c62828; }
    .badge-img { background: #e8f5e9; color: #2e7d32; }
    .badge-default { background: #eceff1; color: #455a64; }
</style>

@php
    $ext = strtolower($extension);
    $isImage = in_array($ext, ['jpg', 'jpeg', 'png']);
    $isPdf = $ext == 'pdf';
@endphp

<div class="file-card position-relative">

    <div class="file-badge {{ $isPdf ? 'badge-pdf' : ($isImage ? 'badge-img' : 'badge-default') }}">
        {{ $ext }}
    </div>

    <div class="file-preview-area">
        @if($isImage)
            <img src="{{ $path }}" alt="{{ $filename }}" class="file-preview-img">
        @elseif($isPdf)
            <i class="bx bxs-file-pdf text-danger" style="font-size: 4rem;"></i>
        @else
            <i class="bx bxs-file text-secondary" style="font-size: 4rem;"></i>
        @endif
    </div>

    <div class="p-3 border-top">
        <h6 class="mb-1 text-truncate" title="{{ $filename }}" style="font-size: 0.9rem;">
            {{ $filename }}
        </h6>

        <small class="text-muted d-block mb-3">
            Ref:
            @if($letter->type == 'incoming')
                <a href="{{ route('transaction.incoming.show', $letter) }}" class="fw-bold text-primary">{{ $letter->reference_number }}</a>
            @else
                <a href="{{ route('transaction.outgoing.show', $letter) }}" class="fw-bold text-primary">{{ $letter->reference_number }}</a>
            @endif
        </small>

        <small class="text-muted d-block mb-3">
            @if($letter->type == 'incoming')
                <a class="fw-bold text-primary">{{ $letter->from }}</a>
            @else
                <a class="fw-bold text-primary">{{ $letter->to }}</a>
            @endif
        </small>

        <div class="d-grid gap-2">
            <a href="{{ $path }}" download class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center">
                <i class="bx bx-download me-1"></i> {{ __('menu.general.download') }}
            </a>

            @if($isImage || $isPdf)
                <a href="{{ $path }}" target="_blank" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center">
                    <i class="bx bx-show me-1"></i> Lihat File
                </a>
            @endif
        </div>
    </div>
</div>
