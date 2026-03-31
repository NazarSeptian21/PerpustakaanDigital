<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Dan Pengembalian Buku</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            margin:40px;
        }

        h1{
            text-align:center;
            margin-bottom:5px;
        }

        .subtitle{
            text-align:center;
            font-size:14px;
            margin-bottom:20px;
        }

        .info{
            margin-bottom:20px;
            font-size:14px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
            table-layout:fixed; /* agar kolom tidak berubah-ubah */
        }

        th{
            background:#4f46e5;
            color:white;
            padding:8px;
            border:1px solid #000;
            font-size:13px;
            text-align:center;
        }

        td{
            padding:8px;
            border:1px solid #000;
            font-size:12px;
            vertical-align:middle;
            word-wrap:break-word;
        }

        tr:nth-child(even){
            background:#f3f4f6;
        }

        .center{
            text-align:center;
        }

        .footer{
            margin-top:50px;
            width:100%;
        }

        .ttd{
            text-align:right;
        }

    </style>

</head>
<body>

<h1>LAPORAN PEMINJAMAN DAN PENGEMBALIAN BUKU</h1>

<div class="subtitle">
    Sistem Perpustakaan Digital
</div>

<hr>

<div class="info">
    <p>Total Peminjaman : <b>{{ $totalPinjam }}</b></p>
    <p>Sedang Dipinjam : <b>{{ $sedangDipinjam }}</b></p>
    <p>Tanggal Cetak : {{ date('d-m-Y') }}</p>
</div>

<table>

    <thead>
        <tr>
            <th style="width:40px;">No</th>
            <th style="width:120px;">User</th>
            <th>Buku</th>
            <th style="width:100px;">Tanggal Pinjam</th>
            <th style="width:120px;">Tanggal Pengembalian</th>
            <th style="width:90px;">Status</th>
        </tr>
    </thead>

    <tbody>

        @foreach($peminjaman as $p)

        <tr>

            <td class="center">{{ $loop->iteration }}</td>

            <td>{{ $p->user->name ?? '-' }}</td>

            <td>{{ $p->book->judul ?? '-' }}</td>

            <td class="center">
                {{ $p->created_at->format('d-m-Y') }}
            </td>

            <td class="center">
                {{ $p->tanggal_pengembalian 
                    ? \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d-m-Y') 
                    : '-' }}
            </td>

            <td class="center">
                {{ $p->status_peminjaman }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>