<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Buku</title>

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
        }

        th{
            background:#4f46e5;
            color:white;
            padding:10px;
            border:1px solid #000;
            font-size:13px;
        }

        td{
            padding:8px;
            border:1px solid #000;
            font-size:13px;
        }

        tr:nth-child(even){
            background:#f3f4f6;
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

<h1>LAPORAN DATA BUKU</h1>
<div class="subtitle">
    Sistem Perpustakaan Digital
</div>

<hr>

<div class="info">
    <p>Total Buku : <b>{{ $totalBuku }}</b></p>
    <p>Total Kategori : <b>{{ $totalKategori }}</b></p>
    <p>Tanggal Cetak : {{ date('d-m-Y') }}</p>
</div>

<table>

    <thead>
        <tr>
            <th width="40">No</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Kategori</th>
            <th width="60">Stok</th>
        </tr>
    </thead>

    <tbody>

        @foreach($books as $b)

        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->penulis }}</td>
            <td>{{ $b->kategori->nama ?? '-' }}</td>
            <td align="center">{{ $b->stok }}</td>
        </tr>

        @endforeach

    </tbody>

</table>



</div>

</body>
</html>