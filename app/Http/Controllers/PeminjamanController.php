<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST DATA
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {

    
        $user = Auth::user();
        $query = Peminjaman::with(['user','book']);

        // Jika bukan admin/petugas, tampilkan miliknya saja
        if (!in_array($user->role, ['admin','petugas'])) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('search')) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->latest()->paginate(10);

        if (in_array($user->role, ['admin','petugas'])) {
            return view('admin.peminjaman.index', compact('data'));
        }

        return view('peminjaman.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE (USER)
    |--------------------------------------------------------------------------
    */
    public function create(Request $request)
{
    $books = Book::where('stok', '>', 0)->get();
    $selectedBook = $request->book_id;

    return view('peminjaman.create', compact('books','selectedBook'));
}

    /*
    |--------------------------------------------------------------------------
    | USER AJUKAN PEMINJAMAN
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_peminjaman'
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_peminjaman' => 'Menunggu'
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success','Peminjaman berhasil diajukan');
    }

    /*
    |--------------------------------------------------------------------------
    | USER LIHAT BUKTI
    |--------------------------------------------------------------------------
    */
    public function bukti($id)
    {
        $pinjam = Peminjaman::with(['user','book'])->findOrFail($id);

        if ($pinjam->user_id !== Auth::id()) {
            abort(403);
        }

        return view('peminjaman.bukti', compact('pinjam'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SETUJUI PEMINJAMAN
    |--------------------------------------------------------------------------
    */
    public function setujui($id)
    {
        try {
            DB::transaction(function () use ($id) {

                $pinjam = Peminjaman::findOrFail($id);

                if ($pinjam->status_peminjaman !== 'Menunggu') {
                    throw new \Exception('Status tidak valid');
                }

                $book = Book::lockForUpdate()->findOrFail($pinjam->book_id);

                if ($book->stok <= 0) {
                    throw new \Exception('Stok buku habis');
                }

                $book->decrement('stok');

                $pinjam->update([
                    'status_peminjaman' => 'Dipinjam'
                ]);
            });

            return back()->with('success','Peminjaman disetujui');

        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN TOLAK PEMINJAMAN
    |--------------------------------------------------------------------------
    */
    public function tolak($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status_peminjaman !== 'Menunggu') {
            return back()->with('error','Status tidak valid');
        }

        $pinjam->update([
            'status_peminjaman' => 'Ditolak'
        ]);

        return back()->with('success','Peminjaman ditolak');
    }

    /*
    |--------------------------------------------------------------------------
    | USER AJUKAN PENGEMBALIAN
    |--------------------------------------------------------------------------
    */
    public function ajukanPengembalian($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->user_id !== Auth::id()) {
            abort(403);
        }

        if ($pinjam->status_peminjaman !== 'Dipinjam') {
            return back()->with('error','Status tidak valid');
        }

        $pinjam->update([
            'status_peminjaman' => 'Menunggu Pengembalian'
        ]);

        return back()->with('success','Pengajuan pengembalian dikirim');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SETUJUI PENGEMBALIAN
    |--------------------------------------------------------------------------
    */
    public function setujuiPengembalian($id)
    {
        try {
            DB::transaction(function () use ($id) {

                $pinjam = Peminjaman::findOrFail($id);

                if ($pinjam->status_peminjaman !== 'Menunggu Pengembalian') {
                    throw new \Exception('Status tidak valid');
                }

                $pinjam->update([
                    'status_peminjaman' => 'Dikembalikan',
                    'tanggal_pengembalian' => now()
                ]);

                $book = Book::lockForUpdate()->findOrFail($pinjam->book_id);
                $book->increment('stok');
            });

            return back()->with('success','Pengembalian disetujui');

        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN TOLAK PENGEMBALIAN
    |--------------------------------------------------------------------------
    */
    public function tolakPengembalian($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status_peminjaman !== 'Menunggu Pengembalian') {
            return back()->with('error','Status tidak valid');
        }

        $pinjam->update([
            'status_peminjaman' => 'Dipinjam'
        ]);

        return back()->with('success','Pengembalian ditolak');
    }

    public function riwayatPeminjaman()
{
    $data = Peminjaman::with(['user','book'])
        ->where('status_peminjaman', 'Dikembalikan')
        ->latest()
        ->paginate(10);

    return view('riwayat.peminjaman', compact('data'));
}

public function riwayatPengembalian()
{
    $data = Peminjaman::with(['user','book'])
        ->where('status_peminjaman', 'Dikembalikan')
        ->latest()
        ->paginate(10);

    return view('riwayat.pengembalian', compact('data'));
}

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status_peminjaman === 'Dipinjam') {
            $book = Book::find($pinjam->book_id);
            if ($book) {
                $book->increment('stok');
            }
        }

        $pinjam->delete();

        return back()->with('success','Data dihapus');
    }
}