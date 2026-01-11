@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('menu.transaction.menu'), __('menu.transaction.outgoing_letter'), __('menu.general.view')]">
        <a href="{{ route('transaction.outgoing.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> {{ __('menu.general.back') }}
        </a>
    </x-breadcrumb>

    <x-letter-card :letter="$data">

        <div class="mt-4 pt-2">

            <div class="divider divider-start">
                <div class="divider-text fw-bold text-uppercase text-primary">
                    <i class="bx bx-list-check me-1"></i> {{ __('menu.general.view') }} Detail
                </div>
            </div>

            <div class="row bg-light rounded p-3 mx-1 border">

                <div class="col-md-6">
                    <dl class="row mb-0">
                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.letter.reference_number') }}</dt>
                        <dd class="col-sm-8 mb-3 text-dark fw-bold">{{ $data->reference_number }}</dd>

                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.letter.agenda_number') }}</dt>
                        <dd class="col-sm-8 mb-3">
                            <span class="badge bg-label-warning">#{{ $data->agenda_number }}</span>
                        </dd>

                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.classification.code') }}</dt>
                        <dd class="col-sm-8 mb-3">{{ $data->classification_code }}</dd>

                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.classification.type') }}</dt>
                        <dd class="col-sm-8 mb-3">{{ $data->classification?->type }}</dd>

                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.letter.to') }}</dt>
                        <dd class="col-sm-8 mb-3 text-dark fw-bold">{{ $data->to }}</dd>
                    </dl>
                </div>

                <div class="col-md-6">
                    <dl class="row mb-0">
                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.letter.letter_date') }}</dt>
                        <dd class="col-sm-8 mb-3">
                            <i class="bx bx-calendar me-1 text-primary"></i> {{ $data->formatted_letter_date }}
                        </dd>

                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.letter.received_date') }}</dt>
                        <dd class="col-sm-8 mb-3">
                            <i class="bx bx-calendar-check me-1 text-success"></i> {{ $data->formatted_received_date }}
                        </dd>

                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.general.created_by') }}</dt>
                        <dd class="col-sm-8 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bx bx-user-circle me-2 fs-5 text-secondary"></i>
                                <span>{{ $data->user?->name }}</span>
                            </div>
                        </dd>

                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.general.created_at') }}</dt>
                        <dd class="col-sm-8 mb-3 text-muted small">{{ $data->formatted_created_at }}</dd>

                        <dt class="col-sm-4 text-muted text-uppercase small fw-bold mb-3">{{ __('model.general.updated_at') }}</dt>
                        <dd class="col-sm-8 mb-3 text-muted small">{{ $data->formatted_updated_at }}</dd>
                    </dl>
                </div>

            </div>
        </div>
    </x-letter-card>

@endsection
