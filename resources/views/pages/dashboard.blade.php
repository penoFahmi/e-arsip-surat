@extends('layout.main')

@push('style')
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
    <style>
        .welcome-card {
            background: linear-gradient(135deg, #ffffff 0%, #f0f2f5 100%);
            border: 1px solid #e1e4e8;
        }
    </style>
@endpush

@push('script')
    <script src="{{asset('sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script>
        // Konfigurasi Grafik
        const options = {
            chart: {
                height: 300,
                type: 'bar',
                toolbar: { show: false },
                fontFamily: 'Public Sans, sans-serif'
            },
            colors: ['#0d47a1', '#ffab00', '#00bcd4'], // Biru, Kuning, Cyan
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true,
                    borderRadius: 8,
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            series: [{
                name: 'Jumlah Surat',
                data: [{{ $todayIncomingLetter }}, {{ $todayOutgoingLetter }}, {{ $todayDispositionLetter }}]
            }],
            xaxis: {
                categories: [
                    '{{ __('dashboard.incoming_letter') }}',
                    '{{ __('dashboard.outgoing_letter') }}',
                    '{{ __('dashboard.disposition_letter') }}',
                ],
                axisBorder: { show: false },
                axisTicks: { show: false },
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 4,
            }
        }

        const chart = new ApexCharts(document.querySelector("#today-graphic"), options);
        chart.render();
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">

            <div class="card mb-4 welcome-card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title text-primary fw-bold mb-2">{{ $greeting }}</h4>
                            <p class="mb-4 text-muted">{{ $currentDate }}</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-label-primary p-2 rounded me-2">
                                    <i class="bx bx-calendar-check"></i>
                                </span>
                                <small class="fw-semibold">*) {{ __('dashboard.today_report') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{asset('sneat/img/man-with-laptop-light.png')}}" height="140" alt="User">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0 fw-bold">{{ __('dashboard.today_graphic') }}</h5>
                        <span class="badge bg-label-warning rounded-pill">{{ __('dashboard.today') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $todayLetterTransaction }}</h2>
                            <span>Total Transaksi</span>
                        </div>
                        <div class="mt-sm-auto">
                            @if($percentageLetterTransaction > 0)
                                <small class="text-success fw-semibold"><i class="bx bx-chevron-up"></i> {{ $percentageLetterTransaction }}%</small>
                            @elseif($percentageLetterTransaction < 0)
                                <small class="text-danger fw-semibold"><i class="bx bx-chevron-down"></i> {{ $percentageLetterTransaction }}%</small>
                            @endif
                        </div>
                    </div>
                    <div id="today-graphic"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 order-1">
            <div class="row g-4">
                <div class="col-6 col-md-12 col-lg-6">
                    <x-dashboard-card-simple
                        :label="__('dashboard.incoming_letter')"
                        :value="$todayIncomingLetter"
                        :daily="true"
                        color="primary"
                        icon="bx-envelope"
                        :percentage="$percentageIncomingLetter"
                    />
                </div>
                <div class="col-6 col-md-12 col-lg-6">
                    <x-dashboard-card-simple
                        :label="__('dashboard.outgoing_letter')"
                        :value="$todayOutgoingLetter"
                        :daily="true"
                        color="warning"
                        icon="bx-paper-plane"
                        :percentage="$percentageOutgoingLetter"
                    />
                </div>
                <div class="col-6 col-md-12 col-lg-6">
                    <x-dashboard-card-simple
                        :label="__('dashboard.disposition_letter')"
                        :value="$todayDispositionLetter"
                        :daily="true"
                        color="info"
                        icon="bx-share"
                        :percentage="$percentageDispositionLetter"
                    />
                </div>
                <div class="col-6 col-md-12 col-lg-6">
                    <x-dashboard-card-simple
                        :label="__('dashboard.active_user')"
                        :value="$activeUser"
                        :daily="false"
                        color="success"
                        icon="bx-user-check"
                        :percentage="0"
                    />
                </div>
            </div>
        </div>
    </div>
@endsection
