<!DOCTYPE html>
<html>
<head>
    <title>Laporan Perpustakaan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 6px; }
    </style>
</head>
<body>

<h2>Laporan Data Buku</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $buku)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->penulis }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
