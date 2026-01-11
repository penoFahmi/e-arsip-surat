<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Agenda Surat Keluar - {{ config('app.name') }}</title>
    <style>
        /* Pengaturan Kertas A4 Landscape */
        @page {
            size: A4 landscape;
            margin: 15mm; /* Margin standar dinas */
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            color: #000;
        }

        /* Styling Kop Surat */
        .header-table {
            width: 100%;
            margin-bottom: 10px;
            border-bottom: 3px double black; /* Garis Ganda Khas Surat Dinas */
            padding-bottom: 10px;
        }
        .header-logo {
            width: 80px; /* Ukuran Logo */
            text-align: center;
        }
        .header-text {
            text-align: center;
        }
        .header-instansi {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }
        .header-alamat {
            font-size: 10pt;
            font-style: italic;
            margin: 0;
        }

        /* Judul Laporan */
        .report-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
            text-decoration: underline;
        }

        /* Info Filter (Periode) */
        .filter-info {
            font-size: 11pt;
            margin-bottom: 10px;
        }

        /* Tabel Data */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11pt;
        }
        table.data-table th, table.data-table td {
            border: 1px solid black;
            padding: 6px 8px;
            vertical-align: top;
        }
        table.data-table th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }
        table.data-table td {
            text-align: left;
        }

        /* Helper untuk Text Alignment */
        .text-center { text-align: center !important; }
        .text-right { text-align: right !important; }

        /* Area Tanda Tangan */
        .signature-section {
            margin-top: 40px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            width: 300px;
            text-align: left;
        }

        /* Sembunyikan elemen saat print jika ada tombol print manual */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>

<body onload="window.print()">

    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="{{ asset('logo-black.png') }}" alt="Logo" width="75">
            </td>
            <td class="header-text">
                <h2 class="header-instansi">{{ $config['institution_name'] }}</h2>
                <p class="header-alamat">{{ $config['institution_address'] }}</p>
                <p class="header-alamat">
                    Telepon: {{ $config['institution_phone'] }} | Email: {{ $config['institution_email'] }}
                </p>
            </td>
        </tr>
    </table>

    <h3 class="report-title">{{ $title }}</h3>

    @if($since && $until)
    <div class="filter-info">
        <table>
            <tr>
                <td width="100"><strong>Periode</strong></td>
                <td>: {{ \Carbon\Carbon::parse($since)->isoFormat('D MMMM Y') }} s/d {{ \Carbon\Carbon::parse($until)->isoFormat('D MMMM Y') }}</td>
            </tr>
            @if($filter)
            <tr>
                <td><strong>Kategori</strong></td>
                <td>: {{ __('model.letter.' . $filter) }}</td>
            </tr>
            @endif
            <tr>
                <td><strong>Total Data</strong></td>
                <td>: {{ count($data) }} Surat</td>
            </tr>
        </table>
    </div>
    @endif

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="10%">{{ __('model.letter.agenda_number') }}</th>
                <th width="15%">{{ __('model.letter.reference_number') }}</th>
                <th width="20%">{{ __('model.letter.to') }}</th>
                <th width="15%">{{ __('model.letter.letter_date') }}</th>
                <th width="20%">{{ __('model.letter.description') }}</th>
                <th width="15%">{{ __('model.letter.note') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $letter)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $letter->agenda_number }}</td>
                    <td>{{ $letter->reference_number }}</td>
                    <td>{{ $letter->to }}</td>
                    <td class="text-center">{{ $letter->formatted_letter_date }}</td>
                    <td>{{ $letter->description }}</td>
                    <td>{{ $letter->note }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data surat pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <p>Pontianak, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Mengetahui,</p>
            <p><strong>Kepala {{ $config['institution_name'] }}</strong></p>

            <br><br><br><br> <p style="text-decoration: underline; font-weight: bold;">{{ $config['name_of_the_head_of_the_institution'] }}</p>
            <p>NIP. {{ $config['nip_of_the_head_of_the_institution'] }}</p>
        </div>
    </div>

</body>
</html>
