<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Agenda Surat Masuk - {{ config('app.name') }}</title>
    <style>
        /* Setup Kertas A4 Landscape */
        @page {
            size: A4 landscape;
            margin: 15mm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            color: #000;
        }

        /* Kop Surat */
        .header-table {
            width: 100%;
            border-bottom: 3px double black;
            margin-bottom: 15px;
            padding-bottom: 10px;
        }
        .header-logo {
            width: 80px;
            text-align: center;
            vertical-align: middle;
        }
        .header-text {
            text-align: center;
            vertical-align: middle;
        }
        .header-instansi {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }
        .header-alamat {
            font-size: 10pt;
            margin: 0;
            font-style: italic;
        }

        /* Judul Laporan */
        .report-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin: 20px 0;
        }

        /* Info Filter */
        .filter-section {
            font-size: 11pt;
            margin-bottom: 15px;
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
            background-color: #f2f2f2; /* Header abu-abu */
            font-weight: bold;
            text-align: center;
        }

        /* Area Tanda Tangan */
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
            page-break-inside: avoid; /* Jangan terpotong saat print */
        }
        .signature-box {
            width: 300px;
            text-align: left;
        }

        .text-center { text-align: center; }
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
                    Email: {{ $config['institution_email'] }} | Telepon: {{ $config['institution_phone'] }}
                </p>
            </td>
        </tr>
    </table>

    <h3 class="report-title">{{ $title }}</h3>

    @if($since && $until)
    <div class="filter-section">
        <table>
            <tr>
                <td width="100"><strong>Periode</strong></td>
                <td>: {{ \Carbon\Carbon::parse($since)->isoFormat('D MMMM Y') }} s/d {{ \Carbon\Carbon::parse($until)->isoFormat('D MMMM Y') }}</td>
            </tr>
            @if($filter)
            <tr>
                <td><strong>Filter</strong></td>
                <td>: {{ __('model.letter.' . $filter) }}</td>
            </tr>
            @endif
            <tr>
                <td><strong>Total Data</strong></td>
                <td>: {{ count($data) }} Surat Masuk</td>
            </tr>
        </table>
    </div>
    @endif

    <table class="data-table">
        <thead>
            <tr>
                <th width="10%">{{ __('model.letter.agenda_number') }}</th>
                <th width="15%">{{ __('model.letter.reference_number') }}</th>
                <th width="20%">{{ __('model.letter.from') }}</th>
                <th width="10%">{{ __('model.letter.received_date') }}</th>
                <th width="20%">{{ __('model.letter.description') }}</th>
                <th width="15%">{{ __('model.letter.note') }}</th>
                <th width="15%">{{ __('model.letter.dispose') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $letter)
                <tr>
                    <td class="text-center">{{ $letter->agenda_number }}</td>
                    <td>{{ $letter->reference_number }}</td>
                    <td>{{ $letter->from }}</td> <td class="text-center">{{ $letter->formatted_letter_date }}</td>
                    <td>{{ $letter->description }}</td>
                    <td>{{ $letter->note }}</td>
                    <td>
                        @if($letter->dispositions->count() > 0)
                            <ul style="padding-left: 15px; margin: 0;">
                                @foreach($letter->dispositions as $disposition)
                                    <li>{{ $disposition->to }}</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data surat masuk pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <p>Pontianak, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Mengetahui,</p>
            <p><strong>Kepala {{ $config['institution_name'] }}</strong></p>

            <br><br><br><br>

            <p style="text-decoration: underline; font-weight: bold;">{{ $config['name_of_the_head_of_the_institution'] }}</p>
            <p>NIP. {{ $config['nip_of_the_head_of_the_institution'] }}</p>
        </div>
    </div>

</body>
</html>
