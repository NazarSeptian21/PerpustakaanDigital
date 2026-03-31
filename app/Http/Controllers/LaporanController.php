<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function cetak()
    {
        $type = request('type');

        if ($type == 'buku') {

            $books = Book::with('kategori')->get();
            $totalBuku = $books->count();
            $totalKategori = Kategori::count();

            $pdf = Pdf::loadView('laporan.buku_pdf', compact(
                'books',
                'totalBuku',
                'totalKategori'
            ));

            return $pdf->download('laporan-data-buku.pdf');
        }

        if ($type == 'peminjaman') {

            $peminjaman = Peminjaman::with(['user','book'])->get();

            $totalPinjam = $peminjaman->count();

            // Perbaikan di sini
            $sedangDipinjam = $peminjaman
                ->where('status_peminjaman', 'Dipinjam')
                ->count();

            $pdf = Pdf::loadView('laporan.peminjaman_pdf', compact(
                'peminjaman',
                'totalPinjam',
                'sedangDipinjam'
            ));

            return $pdf->download('laporan-peminjaman.pdf');
        }

        abort(404);
    }
}