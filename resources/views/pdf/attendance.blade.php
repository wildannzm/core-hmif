<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir - {{ $event->title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 20px;
            color: #1e40af;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .header h2 {
            font-size: 16px;
            color: #374151;
            margin-bottom: 3px;
        }

        .header p {
            font-size: 11px;
            color: #6b7280;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }

        .info-column:last-child {
            padding-right: 0;
            padding-left: 20px;
        }

        .info-item {
            margin-bottom: 8px;
            display: table;
            width: 100%;
        }

        .info-label {
            display: table-cell;
            font-weight: bold;
            color: #374151;
            width: 130px;
        }

        .info-colon {
            display: table-cell;
            width: 15px;
            text-align: center;
        }

        .info-value {
            display: table-cell;
            color: #1f2937;
        }

        .stats {
            background-color: #f3f4f6;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #d1d5db;
        }

        .stats-grid {
            display: table;
            width: 100%;
        }

        .stats-row {
            display: table-row;
        }

        .stats-item {
            display: table-cell;
            padding: 6px 12px;
            text-align: center;
        }

        .stats-item-label {
            font-size: 10px;
            color: #6b7280;
            display: block;
            margin-bottom: 3px;
        }

        .stats-item-value {
            font-size: 18px;
            font-weight: bold;
            display: block;
        }

        .stats-item-value.total {
            color: #2563eb;
        }

        .stats-item-value.hadir {
            color: #059669;
        }

        .stats-item-value.tidak-hadir {
            color: #dc2626;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #9ca3af;
        }

        thead {
            background-color: #1e40af;
            color: white;
        }

        thead th {
            padding: 10px 8px;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            border: 1px solid #6b7280;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody td {
            padding: 8px;
            font-size: 11px;
            border: 1px solid #d1d5db;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-hadir {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-tidak-hadir {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>DAFTAR HADIR</h1>
        <h2>{{ $event->title }}</h2>
    </div>

    <div class="info-section">
        <div class="info-grid">
            <div class="info-column">
                <div class="info-item">
                    <span class="info-label">Nama Event</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $event->title }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Mulai</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">
                        {{ \Carbon\Carbon::parse($event->event_start_date)->translatedFormat('d F Y') }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Waktu Mulai</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">
                        {{ \Carbon\Carbon::parse($event->event_start_date)->format('H:i') }} WIB
                    </span>
                </div>
            </div>
            <div class="info-column">
                @if ($event->location)
                    <div class="info-item">
                        <span class="info-label">Lokasi</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $event->location }}</span>
                    </div>
                @endif
                <div class="info-item">
                    <span class="info-label">Tanggal Selesai</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">
                        {{ \Carbon\Carbon::parse($event->event_end_date)->translatedFormat('d F Y') }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Waktu Selesai</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">
                        {{ \Carbon\Carbon::parse($event->event_end_date)->format('H:i') }} WIB
                    </span>
                </div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 35%;">Nama Peserta</th>
                <th style="width: 15%;">Kode Tiket</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 30%;">Waktu Hadir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendees as $index => $attendee)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $attendee->name }}</td>
                    <td class="text-center" style="font-family: monospace; font-weight: bold;">
                        {{ $attendee->ticket_code }}</td>
                    <td class="text-center">
                        @if ($attendee->is_checked_in)
                            <span class="badge badge-hadir">Hadir</span>
                        @else
                            <span class="badge badge-tidak-hadir">Tidak Hadir</span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{ $attendee->checked_in_at ? $attendee->checked_in_at->translatedFormat('d M Y H:i') : '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Tidak ada data peserta</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
