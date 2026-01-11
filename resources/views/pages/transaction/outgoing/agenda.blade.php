@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('menu.agenda.menu'), __('menu.agenda.outgoing_letter')]">
    </x-breadcrumb>

    <div class="card mb-5">
        <div class="card-header">
            <h5 class="card-title mb-4">Filter Buku Agenda</h5>

            <form action="{{ url()->current() }}" method="get">
                <input type="hidden" name="search" value="{{ $search ?? '' }}">

                <div class="row g-3 align-items-end">
                    <div class="col-md-3 col-6">
                        <x-input-form
                            name="since"
                            :label="__('menu.agenda.start_date')"
                            type="date"
                            :value="$since ? date('Y-m-d', strtotime($since)) : ''"
                        />
                    </div>

                    <div class="col-md-3 col-6">
                        <x-input-form
                            name="until"
                            :label="__('menu.agenda.end_date')"
                            type="date"
                            :value="$until ? date('Y-m-d', strtotime($until)) : ''"
                        />
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="filter" class="form-label text-uppercase text-muted small fw-bold">
                                {{ __('menu.agenda.filter_by') }}
                            </label>
                            <select class="form-select" id="filter" name="filter">
                                <option value="letter_date" @selected(old('filter', $filter) == 'letter_date')>
                                    {{ __('model.letter.letter_date') }}
                                </option>
                                <option value="created_at" @selected(old('filter', $filter) == 'created_at')>
                                    {{ __('model.general.created_at') }} (Waktu Input)
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3 d-flex gap-2">
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="bx bx-filter-alt me-1"></i> {{ __('menu.general.filter') }}
                            </button>

                            <a href="{{ route('agenda.outgoing.print') . '?' . $query }}"
                               target="_blank"
                               class="btn btn-outline-secondary w-100">
                                <i class="bx bx-printer me-1"></i> {{ __('menu.general.print') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <hr class="my-0">

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('model.letter.agenda_number') }}</th>
                        <th>{{ __('model.letter.reference_number') }}</th>
                        <th>{{ __('model.letter.to') }}</th>
                        <th>{{ __('model.letter.letter_date') }}</th>
                    </tr>
                </thead>
                @if($data->count())
                    <tbody class="table-border-bottom-0">
                    @foreach($data as $agenda)
                        <tr>
                            <td>
                                <span class="badge bg-label-warning">
                                    #{{ $agenda->agenda_number }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('transaction.outgoing.show', $agenda) }}" class="fw-bold text-dark">
                                    {{ $agenda->reference_number }}
                                </a>
                                <div class="small text-muted">{{ $agenda->classification?->type }}</div>
                            </td>

                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 200px;" title="{{ $agenda->to }}">
                                    {{ $agenda->to }}
                                </span>
                            </td>

                            <td>
                                <i class="bx bx-calendar text-muted me-1"></i>
                                {{ $agenda->formatted_letter_date }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-label-secondary rounded-circle" style="width: 80px; height: 80px;">
                                        <i class='bx bx-book-bookmark text-secondary' style="font-size: 2.5rem;"></i>
                                    </div>
                                </div>
                                <h6 class="text-muted">Tidak ada data agenda pada periode ini.</h6>
                                <p class="small text-muted">Coba ubah filter tanggal atau kata kunci pencarian.</p>
                            </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $data->appends(['search' => $search, 'since' => $since, 'until' => $until, 'filter' => $filter])->links() !!}
    </div>
@endsection
