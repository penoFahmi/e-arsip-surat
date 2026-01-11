<style>
    .letter-card {
        border: 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    .letter-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(13, 71, 161, 0.1);
    }

    /* Indikator Garis Kiri (Biru = Masuk, Oranye = Keluar) */
    .border-start-primary { border-left: 5px solid #0d47a1; }
    .border-start-warning { border-left: 5px solid #ffab00; }

    /* Typography Nomor Surat */
    .letter-ref {
        font-family: 'Courier New', Courier, monospace; /* Gaya mesin tik */
        font-weight: 700;
        color: #2c3e50;
        letter-spacing: -0.5px;
    }

    /* Style Lampiran */
    .attachment-chip {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        background-color: #f0f2f5;
        border-radius: 20px;
        font-size: 0.85rem;
        color: #566a7f;
        margin-right: 8px;
        margin-bottom: 5px;
        text-decoration: none;
        transition: background 0.2s;
        border: 1px solid transparent;
    }
    .attachment-chip:hover {
        background-color: #e1e4e8;
        color: #0d47a1;
        border-color: #dbe1e6;
    }
</style>

<div class="card mb-4 letter-card {{ $letter->type == 'incoming' ? 'border-start-primary' : 'border-start-warning' }}">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <span class="badge {{ $letter->type == 'incoming' ? 'bg-label-primary' : 'bg-label-warning' }} me-2">
                    {{ __('model.letter.agenda_number') }}: #{{ $letter->agenda_number }}
                </span>

                @if($letter->classification)
                <span class="badge bg-label-secondary" data-bs-toggle="tooltip" title="Klasifikasi Surat">
                    <i class='bx bx-purchase-tag-alt text-xs me-1'></i>
                    {{ $letter->classification->type }}
                </span>
                @endif
            </div>

            <small class="text-muted fw-semibold d-flex align-items-center">
                <i class='bx bx-calendar me-1'></i>
                {{ $letter->formatted_letter_date }}
            </small>
        </div>

        <div class="mb-3">
            <h4 class="mb-1 letter-ref text-uppercase">
                {{ $letter->reference_number }}
            </h4>
            <div class="d-flex align-items-center mt-1 text-muted">
                @if($letter->type == 'incoming')
                    <i class='bx bx-envelope me-2 text-primary'></i>
                    <span>Dari: <strong class="text-dark">{{ $letter->from }}</strong></span>
                @else
                    <i class='bx bx-paper-plane me-2 text-warning'></i>
                    <span>Kepada: <strong class="text-dark">{{ $letter->to }}</strong></span>
                @endif
            </div>
        </div>

        <hr class="my-3 border-light">

        <div class="row">
            <div class="col-md-9">
                <p class="mb-2 text-dark" style="line-height: 1.6;">
                    {{ $letter->description }}
                </p>
                @if($letter->note)
                    <small class="d-block text-secondary fst-italic bg-lighter p-2 rounded mt-2">
                        <i class='bx bx-info-circle me-1'></i> Catatan: {{ $letter->note }}
                    </small>
                @endif

                @if(count($letter->attachments))
                    <div class="mt-3">
                        <small class="text-uppercase text-muted fw-bold d-block mb-2" style="font-size: 0.7rem;">Lampiran:</small>
                        @foreach($letter->attachments as $attachment)
                            <a href="{{ $attachment->path_url }}" target="_blank" class="attachment-chip">
                                @if($attachment->extension == 'pdf')
                                    <i class="bx bxs-file-pdf text-danger me-2"></i>
                                @elseif(in_array($attachment->extension, ['jpg', 'jpeg', 'png']))
                                    <i class="bx bxs-image text-success me-2"></i>
                                @else
                                    <i class="bx bxs-file text-secondary me-2"></i>
                                @endif
                                File {{ $loop->iteration }} ({{ strtoupper($attachment->extension) }})
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-md-3 mt-3 mt-md-0 d-flex flex-column align-items-end justify-content-start gap-2">

                @if($letter->type == 'incoming')
                    <a href="{{ route('transaction.disposition.index', $letter) }}"
                       class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center shadow-sm">
                        <i class='bx bx-share me-1'></i>
                        {{ __('model.letter.dispose') }}
                        <span class="badge bg-white text-primary ms-2 rounded-pill">{{ $letter->dispositions->count() }}</span>
                    </a>
                @endif

                <div class="btn-group w-100">
                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle w-100" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-cog me-1'></i> Kelola
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if(!\Illuminate\Support\Facades\Route::is('*.show'))
                            <li>
                                <a class="dropdown-item" href="{{ route('transaction.' . $letter->type . '.show', $letter) }}">
                                    <i class='bx bx-show me-2'></i> {{ __('menu.general.view') }}
                                </a>
                            </li>
                        @endif

                        <li>
                            <a class="dropdown-item" href="{{ route('transaction.' . $letter->type . '.edit', $letter) }}">
                                <i class='bx bx-edit me-2'></i> {{ __('menu.general.edit') }}
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form action="{{ route('transaction.' . $letter->type . '.destroy', $letter) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger btn-delete">
                                    <i class='bx bx-trash me-2'></i> {{ __('menu.general.delete') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $slot }}
        </div>

    </div>
</div>
