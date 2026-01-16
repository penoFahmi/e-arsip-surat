<style>
    .stats-card {
        border: none;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        position: relative;
        height: 100%;
    }
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(13, 71, 161, 0.15);
    }

    /* Ikon Utama (Kiri) */
    .stats-icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
    }

    /* Watermark Icon (Background) */
    .stats-watermark {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 5rem;
        opacity: 0.1;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    /* Link Overlay (Membuat seluruh kartu bisa diklik jika ada link) */
    .card-link-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 10;
    }
</style>

@php
    // Logika Routing (Dipindahkan ke atas biar HTML bersih)
    $routeUrl = '#';
    $hasLink = false;

    if ($label == __('dashboard.incoming_letter')) {
        $routeUrl = route('transaction.incoming.index');
        $hasLink = true;
    } elseif ($label == __('dashboard.outgoing_letter')) {
        $routeUrl = route('transaction.outgoing.index');
        $hasLink = true;
    } elseif ($label == __('dashboard.active_user')) {
        // Cek Role khusus untuk User
        if (auth()->user()->role != 'staff') {
             $routeUrl = route('user.index');
             $hasLink = true;
        }
    }
@endphp

<div class="card stats-card">
    <div class="card-body d-flex flex-column justify-content-between h-100 position-relative">

        <div class="d-flex justify-content-between align-items-start mb-3 position-relative" style="z-index: 2;">
            <div>
                <p class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    {{ $label }} {{ $daily ? '*' : '' }}
                </p>
                <h2 class="mb-0 fw-bold text-dark">{{ $value }}</h2>
            </div>

            <div class="stats-icon-box bg-label-{{ $color }} text-{{ $color }}">
                <i class="bx {{ $icon }}"></i>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between position-relative" style="z-index: 2;">
            <div>
                @if($percentage > 0)
                    <span class="badge bg-label-success rounded-pill">
                        <i class="bx bx-up-arrow-alt"></i> {{ $percentage }}%
                    </span>
                    <small class="text-muted ms-1" style="font-size: 0.7rem;">dari kemarin</small>
                @elseif($percentage < 0)
                    <span class="badge bg-label-danger rounded-pill">
                        <i class="bx bx-down-arrow-alt"></i> {{ abs($percentage) }}%
                    </span>
                    <small class="text-muted ms-1" style="font-size: 0.7rem;">dari kemarin</small>
                @else
                    <small class="text-muted">Tidak ada perubahan</small>
                @endif
            </div>
        </div>

        <i class="bx {{ $icon }} stats-watermark text-{{ $color }}"></i>

        @if($label != __('dashboard.disposition_letter') && $hasLink)
            <a href="{{ $routeUrl }}" class="card-link-overlay" title="Lihat Detail {{ $label }}"></a>
        @endif
    </div>
</div>
