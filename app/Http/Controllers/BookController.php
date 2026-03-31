<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Kategori;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('kategori')
                     ->withAvg('reviews', 'rating');

        $search = $request->q;
        $filter = $request->filter;

        if ($search) {

            if ($filter == 'penulis') {
                $query->where('penulis', 'like', '%' . $search . '%');
            } 
            elseif ($filter == 'kategori') {
                $query->whereHas('kategori', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                });
            } 
            else {
                $query->where('judul', 'like', '%' . $search . '%');
            }
        }

        $books = $query->latest()->get();

        return view('book.index', compact('books'));
    }

    public function show($id)
    {
       
$book = Book::with('kategori', 'reviews.user')
                ->withAvg('reviews', 'rating')
                ->findOrFail($id);

                // Kalau belum ada rating, jadikan 0
    $book->reviews_avg_rating = $book->reviews_avg_rating ?? 0;

    return view('book.show', compact('book'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('book.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'kategori_id' => 'required',
            'isbn' => 'required|unique:books,isbn',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('covers'), $filename);
            $data['cover'] = $filename;
        }

        Book::create($data);

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $kategoris = Kategori::all();

        return view('book.edit', compact('book', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'kategori_id' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'penerbit' => 'required',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {

            // 🔥 HAPUS COVER LAMA
            if ($book->cover && file_exists(public_path('covers/' . $book->cover))) {
                unlink(public_path('covers/' . $book->cover));
            }

            // 🔥 SIMPAN COVER BARU
            $file = $request->file('cover');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('covers'), $filename);

            $data['cover'] = $filename;
        }

        $book->update($data);

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // 🔥 HAPUS COVER JUGA SAAT DELETE
        if ($book->cover && file_exists(public_path('covers/' . $book->cover))) {
            unlink(public_path('covers/' . $book->cover));
        }

        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil dihapus');
    }

    // 🔥 TAMBAH STOK KHUSUS ADMIN
    public function tambahStok(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $book = Book::findOrFail($id);
        $book->stok += $request->jumlah;
        $book->save();

        return back()->with('success', 'Stok berhasil ditambahkan');
    }
}