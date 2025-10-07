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
            margin: 2.54cm 2.54cm 2.54cm 2.54cm;
            /* Normal margin (1 inch) */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
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

        /* Column widths for all transactions (with type column) */
        .col-no-all {
            width: 5%;
            min-width: 30px;
        }

        .col-date-all {
            width: 12%;
            min-width: 80px;
        }

        .col-type-all {
            width: 12%;
            min-width: 80px;
        }

        .col-desc-all {
            width: 35%;
            min-width: 200px;
        }

        .col-amount-all {
            width: 15%;
            min-width: 100px;
        }

        .col-source-all {
            width: 21%;
            min-width: 120px;
        }

        /* Column widths for filtered transactions (without type column) */
        .col-no-filtered {
            width: 5%;
            min-width: 30px;
        }

        .col-date-filtered {
            width: 15%;
            min-width: 100px;
        }

        .col-desc-filtered {
            width: 45%;
            min-width: 250px;
        }

        .col-amount-filtered {
            width: 15%;
            min-width: 100px;
        }

        .col-source-filtered {
            width: 20%;
            min-width: 120px;
        }

        /* Removed background colors for cleaner appearance */

        .summary-table {
            margin-top: 20px;
            width: 300px;
            margin-left: auto;
        }

        .summary-table th,
        .summary-table td {
            padding: 8px 12px;
            font-size: 11px;
        }

        .summary-label {
            font-weight: bold;
            width: 60%;
        }

        .summary-amount {
            text-align: center;
            width: 40%;
        }

        .balance-positive {
            color: #059669;
            font-weight: bold;
        }

        .balance-negative {
            color: #dc2626;
            font-weight: bold;
        }

        @media print {
            body {
                font-size: 10px;
                margin: 2.54cm 2.54cm 2.54cm 2.54cm;
            }

            table {
                width: 100%;
                max-width: 100%;
            }

            th,
            td {
                font-size: 9px;
                padding: 4px 3px;
            }
        }

        @page {
            size: A4 landscape;
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
                @if ($show_type_column)
                    <th class="col-no-all text-center">No</th>
                    <th class="col-date-all">Tanggal</th>
                    <th class="col-type-all">Jenis</th>
                    <th class="col-desc-all">Deskripsi</th>
                    <th class="col-source-all">Sumber Dana</th>
                    <th class="col-amount-all">Jumlah (Rp)</th>
                @else
                    <th class="col-no-filtered text-center">No</th>
                    <th class="col-date-filtered">Tanggal</th>
                    <th class="col-desc-filtered">Deskripsi</th>
                    <th class="col-source-filtered">Sumber Dana</th>
                    <th class="col-amount-filtered">Jumlah (Rp)</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        @php
                            $date = is_string($transaction->transaction_date)
                                ? \Carbon\Carbon::parse($transaction->transaction_date)
                                : $transaction->transaction_date;
                        @endphp
                        {{ $date->locale('id')->translatedFormat('d F Y') }}
                    </td>
                    @if ($show_type_column)
                        <td class="text-center">
                            {{ $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                        </td>
                    @endif
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->funding_source ?: '-' }}</td>
                    <td class="text-center">
                        {{ 'Rp ' . number_format($transaction->amount, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $show_type_column ? '6' : '5' }}" class="text-center">
                        Tidak ada data transaksi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Summary Table -->
    @if ($transactions->isNotEmpty())
        <table class="summary-table">
            <thead>
                <tr>
                    <th class="summary-label">Ringkasan</th>
                    <th class="summary-amount">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @if (!$filter_type || $filter_type === 'income')
                    <tr>
                        <td class="summary-label">Total Pemasukan:</td>
                        <td class="summary-amount">Rp {{ number_format($total_income, 0, ',', '.') }}</td>
                    </tr>
                @endif
                @if (!$filter_type || $filter_type === 'expense')
                    <tr>
                        <td class="summary-label">Total Pengeluaran:</td>
                        <td class="summary-amount">Rp {{ number_format($total_expense, 0, ',', '.') }}</td>
                    </tr>
                @endif
                @if (!$filter_type)
                    <tr>
                        <td class="summary-label">Saldo Akhir:</td>
                        <td class="summary-amount {{ $balance >= 0 ? 'balance-positive' : 'balance-negative' }}">
                            Rp {{ number_format($balance, 0, ',', '.') }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    @endif
</body>

</html>
