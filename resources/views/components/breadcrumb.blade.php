<div class="page-header-container">
    @if(count($values))
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row py-3 mb-4 border-bottom-dashed">

            <div class="mb-2 mb-md-0">
                <h4 class="fw-bold mb-0 d-flex align-items-center flex-wrap">
                    @foreach($values as $value)
                        @if($loop->last)
                            <span class="text-primary">{{ $value }}</span>
                        @else
                            <span class="text-muted fw-light">{{ $value }}</span>

                            <i class='bx bx-chevron-right text-muted mx-2' style="font-size: 1.2rem;"></i>
                        @endif
                    @endforeach
                </h4>
            </div>

            <div class="d-flex align-items-center flex-wrap gap-2">
                {{ $slot }}
            </div>

        </div>
    @endif
</div>

<style>
    /* Memberikan garis putus-putus halus di bawah header agar rapi */
    .border-bottom-dashed {
        border-bottom: 1px dashed #e0e0e0;
        padding-bottom: 1rem !important;
    }

    /* Responsif untuk HP: Tombol penuh lebar */
    @media (max-width: 576px) {
        .page-header-container .d-flex.gap-2 {
            width: 100%;
        }
        .page-header-container .d-flex.gap-2 > * {
            width: 100%; /* Tombol jadi full width di HP */
            margin-top: 5px;
        }
    }
</style>
