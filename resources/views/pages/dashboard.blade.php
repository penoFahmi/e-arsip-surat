@extends('layout.main')

@push('style')
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
    <style>
        .welcome-card {
            background-color: #e7e7ff; /* Soft primary khas Sneat */
            border: none;
        }
        .stats-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }
    </style>
@endpush

@push('script')
    <script src="{{asset('sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script>
        // ... (Script chartData & options tetap sama seperti sebelumnya, tidak perlu diubah karena sudah konek controller)
        const chartData = {
            today: [{{ $todayIncomingLetter ?? 0 }}, {{ $todayOutgoingLetter ?? 0 }}, {{ $todayDispositionLetter ?? 0 }}],
            week: [{{ $weekIncomingLetter ?? 0 }}, {{ $weekOutgoingLetter ?? 0 }}, {{ $weekDispositionLetter ?? 0 }}],
            month: [{{ $monthIncomingLetter ?? 0 }}, {{ $monthOutgoingLetter ?? 0 }}, {{ $monthDispositionLetter ?? 0 }}],
            year: [{{ $yearIncomingLetter ?? 0 }}, {{ $yearOutgoingLetter ?? 0 }}, {{ $yearDispositionLetter ?? 0 }}]
        };

        const options = {
            chart: { height: 350, type: 'bar', toolbar: { show: false } },
            plotOptions: { bar: { columnWidth: '40%', borderRadius: 10, distributed: true } },
            colors: ['#696cff', '#ffab00', '#03c3ec'],
            series: [{ name: 'Jumlah Surat', data: chartData.today }],
            xaxis: {
                categories: ['Masuk', 'Keluar', 'Disposisi'],
                axisBorder: { show: false },
                labels: { style: { fontSize: '12px' } }
            },
            dataLabels: { enabled: false },
            grid: { strokeDashArray: 7, padding: { left: 0, right: 0 } }
        };

        const chart = new ApexCharts(document.querySelector("#transaction-graphic"), options);
        chart.render();

        function updateChart(filterType, element) {
            chart.updateSeries([{ data: chartData[filterType] }]);
            document.querySelectorAll('.nav-pills .nav-link').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
        }
    </script>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-4 mb-md-0">
            <x-dashboard-card-simple :label="__('dashboard.incoming_letter')" :value="$todayIncomingLetter" :daily="true" color="primary" icon="bx-envelope" :percentage="$percentageIncomingLetter" />
        </div>
        <div class="col-md-3 col-6 mb-4 mb-md-0">
            <x-dashboard-card-simple :label="__('dashboard.outgoing_letter')" :value="$todayOutgoingLetter" :daily="true" color="warning" icon="bx-paper-plane" :percentage="$percentageOutgoingLetter" />
        </div>
        <div class="col-md-3 col-6">
            <x-dashboard-card-simple :label="__('dashboard.disposition_letter')" :value="$todayDispositionLetter" :daily="true" color="info" icon="bx-share" :percentage="$percentageDispositionLetter" />
        </div>
        <div class="col-md-3 col-6">
            <x-dashboard-card-simple :label="__('dashboard.active_user')" :value="$activeUser" :daily="false" color="success" icon="bx-user-check" :percentage="0" />
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100 welcome-card">
                <div class="card-body text-center">
                    <img src="{{asset('sneat/img/man-surat.png')}}" height="150" alt="View Badge User" class="mb-3">
                    <h4 class="card-title text-primary">{{ $greeting }}!</h4>
                    <p class="mb-4 px-xl-3 small text-muted">
                        Hari ini adalah <strong>{{ $currentDate }}</strong>.<br>
                        Anda memiliki <strong>{{ $todayLetterTransaction }}</strong> transaksi baru hari ini.
                    </p>
                    <a href="javascript:;" class="btn btn-sm btn-primary">Lihat Laporan</a>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2 fw-bold">Grafik Aktivitas Surat</h5>
                        <small class="text-muted">Perbandingan data real-time</small>
                    </div>
                    <ul class="nav nav-pills nav-pills-rounded bg-label-secondary p-1" role="tablist">
                        <li class="nav-item"><button class="nav-link active btn-sm" onclick="updateChart('today', this)">Hari</button></li>
                        <li class="nav-item"><button class="nav-link btn-sm" onclick="updateChart('week', this)">Minggu</button></li>
                        <li class="nav-item"><button class="nav-link btn-sm" onclick="updateChart('month', this)">Bulan</button></li>
                    </ul>
                </div>
                <div class="card-body mt-3">
                    <div id="transaction-graphic"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection