<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            margin: 20px;
        }

        .nowrap {
            white-space: nowrap;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .periode {
            text-align: center;
            margin-bottom: 15px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        td.text-left {
            text-align: left;
        }

        td.text-center {
            text-align: center;
        }

        td.text-right {
            text-align: right;
        }

        /* Lebar kolom (PDF friendly) */
        .col-no {
            width: 4%;
        }

        .col-pelanggan {
            width: 18%;
        }

        .col-mobil {
            width: 18%;
        }

        .col-lama {
            width: 8%;
        }

        .col-harga {
            width: 14%;
        }

        .col-tgl {
            width: 12%;
        }

        .col-status {
            width: 8%;
        }
    </style>
</head>

<body>
    <h2>Laporan Transaksi DriveRent</h2>

    @if (request('tgl_awal') && request('tgl_akhir'))
        <p>Periode: {{ request('tgl_awal') }} s/d {{ request('tgl_akhir') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-pelanggan">Pelanggan</th>
                <th class="col-mobil">Mobil</th>
                <th class="col-lama nowrap">Lama Penyewaan</th>
                <th class="col-harga nowrap">Total Harga</th>
                <th class="col-tgl nowrap">Tanggal Pesan</th>
                <th class="col-tgl nowrap">Tanggal Kembali</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-left">{{ $item->pelanggan->nama_pelanggan }}</td>
                    <td class="text-left nowrap">{{ $item->mobil->merek }}</td>
                    <td class="text-center">{{ $item->lama_penyewaan }} hari</td>
                    <td class="text-right nowrap">
                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                    </td>
                    <td class="text-center">{{ $item->tgl_pesan }}</td>
                    <td class="text-center">{{ $item->tgl_kembali }}</td>
                    <td class="text-center">{{ strtoupper($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
