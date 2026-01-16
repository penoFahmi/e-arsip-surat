<style>
    .disposition-card {
        border: 1px solid #e1e4e8;
        border-left: 4px solid #696cff;
        background-color: #fdfdfd;
        border-radius: 8px;
        transition: all 0.2s;
    }
    .disposition-card:hover {
        background-color: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-color: #d9dee3;
    }
    .disposition-arrow {
        font-size: 1.5rem;
        color: #b0b5c1;
        margin-right: 10px;
    }
    .due-date-badge {
        background-color: #ffe0db;
        color: #ff3e1d;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
    }
</style>

<div class="card mb-3 disposition-card">
    <div class="card-body p-3">

        <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex align-items-center">
                <i class='bx bx-subdirectory-right disposition-arrow'></i>

                <div>
                    <h6 class="mb-0 fw-bold text-dark">
                        {{ $disposition->to }}
                    </h6>

                    @if($disposition->status)
                        <span class="badge bg-label-primary mt-1" style="font-size: 0.7rem;">
                            {{ $disposition->status->status }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="text-end d-none d-sm-block">
                    <small class="text-muted d-block" style="font-size: 0.7rem;">{{ __('model.disposition.due_date') }}</small>
                    <span class="due-date-badge">
                        <i class='bx bx-time-five me-1'></i> {{ $disposition->formatted_due_date }}
                    </span>
                </div>

                <div class="dropdown ms-2">
                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('transaction.disposition.edit', [$letter, $disposition]) }}">
                            <i class='bx bx-edit-alt me-2'></i> {{ __('menu.general.edit') }}
                        </a>

                        <div class="dropdown-divider"></div>

                        <form action="{{ route('transaction.disposition.destroy', [$letter, $disposition]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger btn-delete">
                                <i class='bx bx-trash me-2'></i> {{ __('menu.general.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-sm-none mt-3">
            <span class="due-date-badge w-100 justify-content-center">
                <i class='bx bx-time-five me-1'></i> Batas: {{ $disposition->formatted_due_date }}
            </span>
        </div>

        <hr class="my-3 border-light">

        <div class="ps-md-4 ms-md-1">
            <div class="d-flex align-items-start">
                <i class='bx bxs-quote-alt-left text-secondary opacity-25 display-6 me-2'></i>
                <div>
                    <p class="mb-1 text-dark" style="font-size: 0.95rem; line-height: 1.6;">
                        {{ $disposition->content }}
                    </p>

                    @if($disposition->note)
                        <div class="mt-2 bg-lighter p-2 rounded d-flex align-items-start text-secondary">
                            <i class='bx bx-info-circle me-2 mt-1'></i>
                            <small class="fst-italic">{{ $disposition->note }}</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-2">
            {{ $slot }}
        </div>

    </div>
</div>
