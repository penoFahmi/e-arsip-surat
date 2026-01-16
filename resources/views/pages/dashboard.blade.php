@extends('layout.main')

@push('style')
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
    <style>
        .welcome-card {
            background: linear-gradient(135deg, #ffffff 0%, #f0f2f5 100%);
            border: 1px solid #e1e4e8;
        }
        .nav-pills .nav-link {
            font-size: 0.75rem;
            padding: 0.4rem 0.8rem;
        }
    </style>
@endpush

@push('script')
    <script src="{{asset('sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script>
        const chartData = {
            today: [
                {{ $todayIncomingLetter ?? 0 }},
                {{ $todayOutgoingLetter ?? 0 }},
                {{ $todayDispositionLetter ?? 0 }}
            ],
            week: [
                {{ $weekIncomingLetter ?? 0 }},
                {{ $weekOutgoingLetter ?? 0 }},
                {{ $weekDispositionLetter ?? 0 }}
            ],
            month: [
                {{ $monthIncomingLetter ?? 0 }},
                {{ $monthOutgoingLetter ?? 0 }},
                {{ $monthDispositionLetter ?? 0 }}
            ],
            year: [
                {{ $yearIncomingLetter ?? 0 }},
                {{ $yearOutgoingLetter ?? 0 }},
                {{ $yearDispositionLetter ?? 0 }}
            ]
        };

        const options = {
            chart: {
                height: 300,
                type: 'bar',
                toolbar: { show: false },
                fontFamily: 'Public Sans, sans-serif',
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                }
            },
            colors: ['#0d47a1', '#ffab00', '#00bcd4'],
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                    borderRadius: 6,
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            series: [{
                name: 'Jumlah Surat',
                data: chartData.today
            }],
            xaxis: {
                categories: [
                    '{{ __('dashboard.incoming_letter') }}',
                    '{{ __('dashboard.outgoing_letter') }}',
                    '{{ __('dashboard.disposition_letter') }}',
                ],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: {
                        fontSize: '13px',
                        colors: '#566a7f'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#566a7f'
                    }
                }
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 4,
                padding: { top: 0, right: 0, bottom: 0, left: 10 }
            }
        };

        const chart = new ApexCharts(document.querySelector("#transaction-graphic"), options);
        chart.render();


        function updateChart(filterType, element) {
            chart.updateSeries([{
                data: chartData[filterType]
            }]);

            const buttons = document.querySelectorAll('.nav-pills .nav-link');
            buttons.forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
        }
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
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2 fw-bold">Statistik Surat</h5>
                        <small class="text-muted">Grafik jumlah transaksi surat</small>
                    </div>

                    <div class="d-flex align-items-center">
                        <ul class="nav nav-pills p-1 rounded-pill bg-label-secondary" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active rounded-pill" onclick="updateChart('today', this)">
                                    Hari
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link rounded-pill" onclick="updateChart('week', this)">
                                    Minggu
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link rounded-pill" onclick="updateChart('month', this)">
                                    Bulan
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link rounded-pill" onclick="updateChart('year', this)">
                                    Tahun
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-start gap-1">
                            <h2 class="mb-0 fw-bold">{{ $todayLetterTransaction }}</h2>
                            <span class="text-muted">Total Transaksi (Harian)</span>
                        </div>
                        <div class="mt-sm-auto">
                            @if($percentageLetterTransaction > 0)
                                <span class="badge bg-label-success rounded-pill">
                                    <i class="bx bx-trending-up"></i> +{{ $percentageLetterTransaction }}%
                                </span>
                            @elseif($percentageLetterTransaction < 0)
                                <span class="badge bg-label-danger rounded-pill">
                                    <i class="bx bx-trending-down"></i> {{ $percentageLetterTransaction }}%
                                </span>
                            @endif
                        </div>
                    </div>

                    <div id="transaction-graphic"></div>
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
