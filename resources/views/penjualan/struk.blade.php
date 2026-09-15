<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk #{{ $penjualan->id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 280px;
            margin: 0 auto;
            padding: 10px;
        }
        .text-center { text-align: center; }
        .line { border-bottom: 1px dashed #000; margin: 8px 0; }
        table { width: 100%; font-size: 12px; }
        .no-print { margin-top: 15px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="text-center">
        <h3>TOKO KASIR</h3>
        <p>Jl. Merdeka No. 45</p>
    </div>

    <div class="line"></div>

    <div style="font-size: 12px;">
        No. Transaksi: #{{ $penjualan->id }}<br>
        Kasir: {{ $penjualan->user->name }}<br>
        Tanggal: {{ $penjualan->updated_at->format('d-m-Y H:i') }}
    </div>

    <div class="line"></div>

    <table>
        @foreach($penjualan->itemPenjualan as $item)
        <tr>
            <td colspan="2"><strong>{{ $item->produk->nama }}</strong></td>
        </tr>
        <tr>
            <td>{{ $item->kuantitas }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
            <td style="text-align: right;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

  <table>
        <tr>
            <td><strong>Total:</strong></td>
            <td style="text-align: right;"><strong>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Metode:</td>
            <td style="text-align: right;">{{ $penjualan->metode_pembayaran }}</td>
        </tr>
        <tr>
            <td>Bayar:</td>
            <td style="text-align: right;">Rp {{ number_format($bayar ?? $penjualan->total_pembayaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembali:</td>
            <td style="text-align: right;">
                Rp {{ number_format(($bayar ?? $penjualan->total_pembayaran) - $penjualan->total_pembayaran, 0, ',', '.') }}
            </td>
        </tr>
    </table>
    
    <div class="line"></div>

    <div class="text-center">
        <p>Terima Kasih!<br>Selamat Belanja Kembali</p>
    </div>

    <div class="no-print text-center">
        <button onclick="window.print()">Cetak Struk</button>
        <a href="{{ route('penjualan.index') }}">Kembali ke Dashboard</a>
    </div>

</body>
</html>