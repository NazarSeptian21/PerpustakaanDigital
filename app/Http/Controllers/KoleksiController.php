<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()
            ->koleksiBuku()
            ->with('kategori')
            ->withAvg('reviews', 'rating');

        // 🔎 SEARCH
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // ✅ PAGINATION
        $books = $query->paginate(10);

        // 🔥 Ambil ID buku yang tampil di halaman ini saja
        $bookIds = $books->pluck('id');

        // 🔥 Cek buku mana yang sedang dipinjam (oleh siapa pun)
        $bukuSedangDipinjam = Peminjaman::whereIn('book_id', $bookIds)
            ->where('status_peminjaman', 'Dipinjam')
            ->pluck('book_id')
            ->toArray();

        return view('koleksi.index', compact('books', 'bukuSedangDipinjam'));
    }

    public function store(Book $book)
    {
        Auth::user()->koleksiBuku()->syncWithoutDetaching([$book->id]);

        return back()->with('success','Ditambahkan ke koleksi');
    }

    public function destroy(Book $book)
    {
        Auth::user()->koleksiBuku()->detach($book->id);

        return back()->with('success','Dihapus dari koleksi');
    }
}