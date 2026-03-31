<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;

class UserManagementController extends Controller
{
    // menampilkan data pengguna (user)
    public function pengguna()
    {
        $pengguna = User::where('role', 'user')->get();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    // menampilkan data petugas
    public function petugas()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.petugas.index', compact('petugas'));
    }
}

