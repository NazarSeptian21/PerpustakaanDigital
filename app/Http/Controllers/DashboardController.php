<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Activity;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        if ($role === 'petugas') {
            return redirect()->route('dashboard.petugas');
        }

        return redirect()->route('dashboard.user');
    }

    // ================= ADMIN =================
    public function admin()
    {
        $totalBuku        = Book::count();
        $totalKategori    = Kategori::count();
        $totalPeminjaman  = Peminjaman::count();
        $totalUlasan      = Review::count();
        $totalUser        = User::where('role', 'user')->count();


        return view('dashboard.admin', compact(
            'totalBuku',
            'totalKategori',
            'totalPeminjaman',
            'totalUlasan',
            'totalUser'
        ));
    }

    // ================= PETUGAS =================
    public function petugas()
    {
        $totalBuku        = Book::count();
        $totalKategori    = Kategori::count();
        $totalDipinjam    = Peminjaman::whereDate('created_at', today())->count();
        $totalTerlambat   = Peminjaman::whereDate('tanggal_pengembalian', '<', now())->count();
        $totalUlasan      = Review::count();
        $totalUser        = User::where('role', 'user')->count();


        $activities = Activity::latest()->limit(10)->get();

        return view('dashboard.petugas', compact(
            'totalBuku',
            'totalKategori',
            'totalDipinjam',
            'totalTerlambat',
            'totalUlasan',
            'totalUser',
            'activities'
        ));
    }

    // ================= USER =================
    public function user()
    {
        $userId = auth()->id();

        $totalBuku = Book::count();

        // HANYA ULASAN MILIK USER INI
        $totalUlasan = Review::where('user_id', $userId)->count();

        // HANYA PEMINJAMAN MILIK USER INI
        $totalDipinjam = Peminjaman::where('user_id', $userId)->count();

        return view('dashboard.user', compact(
            'totalBuku',
            'totalUlasan',
            'totalDipinjam'
        ));
    }
}
