<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            margin: 2cm 1cm 2cm 1cm;
            /* Minimal margins for maximum table space */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            /* padding-bottom: 20px; */
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 12px;
            color: #333;
            margin-bottom: 3px;
            font-weight: normal;
        }

        .info {
            margin-bottom: 20px;
            font-size: 11px;
        }

        .info-row {
            margin-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
            /* Force table to respect column widths */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 4px;
            text-align: left;
            vertical-align: top;
            font-size: 10px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
        }

        th {
            background-color: #e8e8e8;
            font-weight: bold;
            text-align: center;
            font-size: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-column {
            width: 5%;
            text-align: center;
            min-width: 30px;
        }

        .letter-number-column {
            width: 18%;
            min-width: 100px;
        }

        .date-column {
            width: 15%;
            text-align: center;
            min-width: 80px;
        }

        .sender-column,
        .recipient-column,
        .sent-to-column {
            width: 20%;
            min-width: 120px;
        }

        .subject-column {
            width: 25%;
            min-width: 150px;
        }

        .attachment-column {
            width: 17%;
            min-width: 100px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }

        .signature-area {
            margin-top: 40px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 200px;
        }

        .signature-line {
            margin-top: 60px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }

        .page-break {
            page-break-before: always;
        }

        @media print {
            body {
                font-size: 10px;
                margin: 1.5cm 0.5cm 1.5cm 0.5cm;
            }

            table {
                width: 100%;
                max-width: 100%;
            }

            th,
            td {
                font-size: 9px;
                padding: 4px 3px;
                word-break: break-word;
            }
        }

        /* Ensure table doesn't overflow */
        @page {
            size: A4;
            margin: 1cm;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="title">{{ $title }}</div>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                @if ($type === 'incoming')
                    <th class="no-column">No</th>
                    <th class="letter-number-column">Nomor Surat</th>
                    <th class="date-column">Tanggal Terima</th>
                    <th class="date-column">Tanggal Pelaksanaan</th>
                    <th class="sender-column">Pengirim</th>
                    <th class="recipient-column">Penerima</th>
                @else
                    <th class="no-column">No</th>
                    <th class="letter-number-column">Nomor Surat</th>
                    <th class="date-column">Tanggal Surat</th>
                    <th class="sent-to-column">Dikirim Kepada</th>
                    <th class="subject-column">Perihal</th>
                    <th class="attachment-column">Lampiran</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($letters as $index => $letter)
                <tr>
                    @if ($type === 'incoming')
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $letter->letter_number }}</td>
                        <td class="text-center">
                            @if ($letter->received_date)
                                @php
                                    $receivedDate = is_string($letter->received_date)
                                        ? \Carbon\Carbon::parse($letter->received_date)
                                        : $letter->received_date;
                                @endphp
                                {{ $receivedDate->locale('id')->translatedFormat('d F Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($letter->execution_date)
                                @php
                                    $executionDate = is_string($letter->execution_date)
                                        ? \Carbon\Carbon::parse($letter->execution_date)
                                        : $letter->execution_date;
                                @endphp
                                {{ $executionDate->locale('id')->translatedFormat('d F Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $letter->sender }}</td>
                        <td>{{ $letter->recipient }}</td>
                    @else
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $letter->letter_number }}</td>
                        <td class="text-center">
                            @if ($letter->letter_date)
                                @php
                                    $letterDate = is_string($letter->letter_date)
                                        ? \Carbon\Carbon::parse($letter->letter_date)
                                        : $letter->letter_date;
                                @endphp
                                {{ $letterDate->locale('id')->translatedFormat('d F Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $letter->sent_to }}</td>
                        <td>{{ $letter->subject }}</td>
                        <td>{{ $letter->attachments ?: '-' }}</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $type === 'incoming' ? '6' : '6' }}" class="text-center">
                        Tidak ada data {{ $type === 'incoming' ? 'surat masuk' : 'surat keluar' }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
