<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /*
    |-------------------------------------------------------
    | LIST REVIEW (Search + Pagination)
    |-------------------------------------------------------
    */
    public function index(Request $request)
    {
        // Base Query
        if (Auth::user()->role === 'admin') {
            $query = Review::with(['user', 'book']);
        } else {
            $query = Review::with(['book'])
                ->where('user_id', Auth::id());
        }

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {

                // Cari di komentar
                $q->where('comment', 'like', '%' . $request->search . '%');

                // Jika admin, bisa cari berdasarkan user & buku
                if (Auth::user()->role === 'admin') {
                    $q->orWhereHas('user', function ($uq) use ($request) {
                        $uq->where('name', 'like', '%' . $request->search . '%');
                    });
                }

                // Cari berdasarkan judul buku
                $q->orWhereHas('book', function ($bq) use ($request) {
                    $bq->where('judul', 'like', '%' . $request->search . '%');
                });
            });
        }

        $reviews = $query->latest()
                         ->paginate(10)
                         ->withQueryString();

        return view('reviews.index', compact('reviews'));
    }

    /*
    |-------------------------------------------------------
    | FORM CREATE REVIEW (USER ONLY)
    |-------------------------------------------------------
    */
  public function create($book = null)
{
    if (Auth::user()->role === 'admin') {
        abort(403);
    }

    // Jika datang dari halaman peminjaman
    if ($book) {
        $book = Book::findOrFail($book);
        return view('reviews.create', compact('book'));
    }

    // Jika dari halaman "Tambah Ulasan"
    $books = Book::orderBy('judul')->get();

    return view('reviews.create', compact('books'));
}

    /*
    |-------------------------------------------------------
    | STORE REVIEW
    |-------------------------------------------------------
    */
    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            abort(403);
        }

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'rating'  => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->route('reviews.index')
            ->with('success', 'Ulasan berhasil ditambahkan.');
    }

    /*
    |-------------------------------------------------------
    | DELETE REVIEW (ADMIN ONLY)
    |-------------------------------------------------------
    */
  public function destroy($id)
{
    $review = Review::findOrFail($id);

    // jika bukan admin dan bukan pemilik review
    if (auth()->user()->role !== 'admin' && auth()->id() !== $review->user_id) {
        abort(403);
    }

    $review->delete();

    return redirect()->route('reviews.index')
        ->with('success', 'Ulasan berhasil dihapus.');
}
}

