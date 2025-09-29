<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi - {{ $schedule->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
        }

        .header h1 {
            color: #1e40af;
            font-size: 16px;
            margin: 0 0 8px 0;
            font-weight: bold;
        }



        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #e5e7eb;
            padding: 8px 6px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
            font-weight: bold;
            color: #374151;
            font-size: 10px;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background: #f9fafb;
        }

        .status-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            min-width: 40px;
        }

        .status-hadir {
            background: #d1fae5;
            color: #065f46;
        }

        .status-sakit {
            background: #fef3c7;
            color: #92400e;
        }

        .status-izin {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-alfa {
            background: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Simple Info -->
    <div style="margin-bottom: 20px;">
        <h1 style="font-size: 16px; font-weight: bold; color: #1e40af; margin: 0 0 15px 0; text-align: center;">Daftar
            Absensi</h1>
        <table style="width: 100%; margin-bottom: 15px; border: none;">
            <tr>
                <td style="width: 120px; padding: 2px 0; border: none; font-weight: bold;">Nama Kegiatan</td>
                <td style="width: 10px; padding: 2px 0; border: none; font-weight: bold;">:</td>
                <td style="padding: 2px 0; border: none;">{{ $schedule->name }}</td>
            </tr>
            <tr>
                <td style="width: 120px; padding: 2px 0; border: none; font-weight: bold;">Waktu</td>
                <td style="width: 10px; padding: 2px 0; border: none; font-weight: bold;">:</td>
                <td style="padding: 2px 0; border: none;">
                    {{ $schedule->date->locale('id')->translatedFormat('l, d F Y') }},
                    {{ $schedule->start_time->format('H:i') }} s/d Selesai</td>
            </tr>
            <tr>
                <td style="width: 120px; padding: 2px 0; border: none; font-weight: bold;">Lokasi</td>
                <td style="width: 10px; padding: 2px 0; border: none; font-weight: bold;">:</td>
                <td style="padding: 2px 0; border: none;">{{ $schedule->location }}</td>
            </tr>
        </table>
    </div>

    <!-- Attendance Table -->
    <table>
        <thead>
            <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align: center">Nama</th>
                <th style="text-align: center">Jabatan</th>
                <th style="width: 70px; text-align: center">Waktu Tiba</th>
                <th style="width: 70px; text-align: center">Status</th>
                <th style="text-align: center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $index => $attendance)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $attendance->user->name }}</td>
                    <td>
                        @php
                            $position = $attendance->user->position->name ?? 'Anggota';
                            $department = $attendance->user->department->name ?? '';
                            $bphPositions = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Sekertaris', 'Bendahara'];
                            $isBPH =
                                in_array($position, $bphPositions) ||
                                $department === 'Badan Pengurus Harian' ||
                                $department === 'BPH';
                        @endphp

                        @if ($isBPH)
                            {{ $position === 'Sekertaris' ? 'Sekretaris' : $position }}
                        @elseif($position === 'Koordinator' && $department && !in_array($department, ['Badan Pengurus Harian', 'BPH']))
                            Koordinator {{ $department }}
                        @elseif($department && !in_array($department, ['Badan Pengurus Harian', 'BPH']))
                            Anggota {{ $department }}
                        @else
                            Anggota
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if ($attendance->tap_time)
                            {{ \Carbon\Carbon::parse($attendance->tap_time)->format('H:i') }}
                        @else
                            -
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <span class="status-badge status-{{ strtolower($attendance->status) }}">
                            {{ $attendance->status }}
                        </span>
                    </td>
                    <td style="text-align: center;">{{ $attendance->notes ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
