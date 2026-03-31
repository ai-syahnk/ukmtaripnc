<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #INV-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f5f5f5;
        }

        .invoice-box {
            max-width: 800px;
            margin: 30px auto;
            padding: 40px;
            background: #fff;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .05);
        }

        .invoice-header {
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .invoice-number {
            font-size: 14px;
            color: #666;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .detail-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        .detail-table td:first-child {
            color: #666;
            width: 160px;
        }

        .total-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px 20px;
        }

        .badge-paid {
            background: #198754;
            color: #fff;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        @media print {
            body {
                background: #fff;
            }

            .invoice-box {
                box-shadow: none;
                border: none;
                margin: 0;
                padding: 20px;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        {{-- Header --}}
        <div class="invoice-header d-flex justify-content-between align-items-start">
            <div>
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">#INV-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="text-end">
                <strong>UKM Seni Tari Prabhakala</strong><br>
                <small class="text-muted">Politeknik Negeri Cilacap</small><br>
                <span class="badge-paid mt-2 d-inline-block">LUNAS</span>
            </div>
        </div>

        <div class="row mb-4">
            {{-- Detail Pemesan --}}
            <div class="col-md-6 mb-3">
                <div class="section-title">Diterbitkan untuk</div>
                <table class="detail-table">
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $booking->nama_pemesan }}</td>
                    </tr>
                    <tr>
                        <td>No. Telp</td>
                        <td>: {{ $booking->no_telp }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Pentas</td>
                        <td>: {{ $booking->alamat_pentas }}</td>
                    </tr>
                </table>
            </div>

            {{-- Detail Invoice --}}
            <div class="col-md-6 mb-3">
                <div class="section-title">Detail Invoice</div>
                <table class="detail-table">
                    <tr>
                        <td>Tanggal Invoice</td>
                        <td>: {{ $payment?->confirmed_at?->format('d/m/Y') ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Bayar</td>
                        <td>: {{ $payment?->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Metode</td>
                        <td>: Transfer Bank ({{ $payment?->bank_pengirim ?? '-' }})</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Detail Booking --}}
        <div class="section-title">Detail Booking</div>
        <div class="table-responsive mb-4">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tarian</th>
                        <th class="text-center">Jumlah Penari</th>
                        <th class="text-end">Harga/Penari</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $booking->tari?->nama ?? '-' }}</td>
                        <td class="text-center">{{ $booking->jumlah_penari }}</td>
                        <td class="text-end">Rp {{ number_format((float) $booking->harga_per_penari, 0, ',', '.') }}
                        </td>
                        <td class="text-end">Rp {{ number_format((float) $booking->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($booking->catatan)
        <div class="mb-4">
            <div class="section-title">Catatan</div>
            <p class="mb-0">{{ $booking->catatan }}</p>
        </div>
        @endif

        <div class="total-box d-flex justify-content-between align-items-center mb-4">
            <span class="fw-bold">TOTAL PEMBAYARAN</span>
            <span class="fw-bold fs-5">Rp {{ number_format((float) $booking->total_harga, 0, ',', '.') }}</span>
        </div>

        <div class="d-flex justify-content-center gap-4 mb-4">
            <div class="text-center px-4 py-3"
                style="background: linear-gradient(135deg, #fff8e1, #fff3cd); border-radius: 10px; border: 1px solid #ffc107; min-width: 180px;">
                <div
                    style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #997a00; font-weight: 600; margin-bottom: 4px;">
                    Tanggal Tampil</div>
                <div style="font-size: 20px; font-weight: 700; color: #333;">{{
                    $booking->tanggal_tampil?->format('d/m/Y') ?? '-' }}</div>
            </div>
            <div class="text-center px-4 py-3"
                style="background: linear-gradient(135deg, #e8f5e9, #d4edda); border-radius: 10px; border: 1px solid #28a745; min-width: 180px;">
                <div
                    style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #1b5e20; font-weight: 600; margin-bottom: 4px;">
                    Waktu Tampil</div>
                <div style="font-size: 20px; font-weight: 700; color: #333;">{{ $booking->waktu_tampil ?
                    \Carbon\Carbon::parse($booking->waktu_tampil)->format('H:i') : '-' }} WIB</div>
            </div>
        </div>

        {{-- Print Button --}}
        <div class="text-center mt-4 no-print d-flex justify-content-center gap-2">
            <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary">Kembali</a>
            <button onclick="window.print()" class="btn btn-warning">
                <i class="fas fa-print me-1"></i> Cetak Invoice
            </button>
        </div>
    </div>
</body>

</html>