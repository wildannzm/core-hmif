<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 0;
        }

        body {
            font-family: 'Inter', 'Arial', sans-serif;
            background: white;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 100%;
            background: white;
            position: relative;
            page-break-after: always;
        }

        .ticket:last-child {
            page-break-after: avoid;
        }

        /* Event Banner Image */
        .event-banner-image {
            width: calc(100% - 40px);
            height: 180px;
            object-fit: cover;
            display: block;
            background-color: #f3f4f6;
            margin: 20px 20px 0 20px;
            border-radius: 8px;
        }

        /* Event Title Section */
        .event-title-section {
            padding: 20px 20px 15px;
            background: white;
        }

        .event-title {
            font-size: 22px;
            font-weight: bold;
            color: #000000;
            margin: 0;
            line-height: 1.3;
        }

        /* Location Section */
        .location-section {
            padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .location-label {
            font-family: 'Inter', 'Arial', sans-serif;
            font-size: 11px;
            color: #9ca3af;
            margin-bottom: 6px;
        }

        .location-value {
            font-size: 14px;
            color: #000000;
            font-weight: 600;
            display: block;
        }

        /* Details Grid */
        .details-grid {
            padding: 20px;
            background: white;
        }

        .details-row {
            width: 100%;
            margin-bottom: 16px;
            display: table;
            table-layout: fixed;
        }

        .details-col {
            display: table-cell;
            width: 50%;
            padding-right: 10px;
        }

        .details-col:last-child {
            padding-right: 0;
            padding-left: 10px;
        }

        .field-label {
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .field-value {
            font-size: 13px;
            color: #000000;
            font-weight: bold;
        }

        /* Bottom Section */
        .bottom-section {
            padding: 20px;
            border-top: 2px dashed #d1d5db;
            overflow: hidden;
        }

        .info-cell {
            width: 58%;
            float: left;
        }

        .qr-cell {
            width: 38%;
            float: right;
            text-align: center;
        }

        .info-title {
            font-size: 11px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 10px;
        }

        .info-list {
            margin: 0;
            padding-left: 18px;
            font-size: 7.5px;
            line-height: 1.5;
            color: #374151;
            list-style-type: disc;
        }

        .info-list li {
            margin-bottom: 4px;
        }

        .ticket-count {
            font-size: 10px;
            color: #6b7280;
            margin-top: 12px;
            font-weight: 600;
            clear: both;
            text-align: center;
        }

        .qr-code {
            width: 130px;
            height: 130px;
            display: block;
            margin: 0 auto;
            border: 2px solid #e5e7eb;
            padding: 4px;
            background: white;
        }

        .qr-label {
            font-size: 8px;
            color: #6b7280;
            margin-top: 6px;
            text-align: center;
        }
    </style>
</head>

<body>
    @foreach ($tickets as $index => $ticketData)
        <div class="ticket">
            <!-- Event Banner Image -->
            @if (!empty($ticketData['eventBannerUrl']))
                <img src="{{ $ticketData['eventBannerUrl'] }}" alt="Event Banner" class="event-banner-image">
            @else
                <div class="event-banner-image"></div>
            @endif

            <!-- Event Title -->
            <div class="event-title-section">
                <h1 class="event-title">{{ $ticketData['eventTitle'] }}</h1>
            </div>

            <!-- Location Section -->
            <div class="location-section">
                <div class="location-label">Location / Lokasi</div>
                <div class="location-value">
                    {{ $ticketData['location'] }}
                </div>
            </div>

            <!-- Details Grid -->
            <div class="details-grid">
                <div class="details-row">
                    <div class="details-col">
                        <div class="field-label">Order ID / ID Pemesanan</div>
                        <div class="field-value">{{ $ticketData['orderId'] }}</div>
                    </div>
                    <div class="details-col">
                        <div class="field-label">Ticket Code / Kode Tiket</div>
                        <div class="field-value">{{ $ticketData['ticketCode'] }}</div>
                    </div>
                </div>

                <div class="details-row">
                    <div class="details-col">
                        <div class="field-label">Event Date / Tanggal Event</div>
                        <div class="field-value">{{ $ticketData['eventDate'] }}</div>
                    </div>
                    <div class="details-col">
                        <div class="field-label">Time / Waktu</div>
                        <div class="field-value">{{ $ticketData['eventTime'] }}</div>
                    </div>
                </div>

                <div class="details-row">
                    <div class="details-col">
                        <div class="field-label">Name / Nama</div>
                        <div class="field-value">{{ $ticketData['attendeeName'] }}</div>
                    </div>
                    <div class="details-col">
                        <!-- Empty column -->
                    </div>
                </div>
            </div>

            <!-- Bottom Section with Info and QR -->
            <div class="bottom-section">
                <div class="info-cell">
                    <div class="info-title">Informasi Tiket</div>
                    <ul class="info-list">
                        <li>Tunjukkan e-Tiket/QR Code yang telah diterima kepada panitia di lokasi Event.</li>
                        <li>Pemilik tiket WAJIB menunjukkan Kartu Identitas (KTP/Passport & SIM) yang telah terdaftar
                            untuk verifikasi data di pintu masuk.</li>
                        <li>Setelah sudah terverifikasi, Pemilik tiket dapat memasuki Event. Pengunjung WAJIB mematuhi
                            aturan yang berlaku selama acara berlangsung.</li>
                    </ul>
                </div>
                <div class="qr-cell">
                    <img src="{{ $ticketData['qrCodeUrl'] }}" alt="QR Code" class="qr-code">
                </div>
                <div class="ticket-count">Tiket {{ $index + 1 }} dari {{ count($tickets) }}</div>
            </div>
        </div>
    @endforeach
</body>

</html>
