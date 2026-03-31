<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (Read + Pagination + Search)
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = User::where('role', 'petugas');

        // 🔍 Search berdasarkan nama atau email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $petugas = $query->latest()
                         ->paginate(10)
                         ->withQueryString(); // supaya search tidak hilang saat pagination

        return view('admin.petugas.index', compact('petugas'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE (Form)
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.petugas.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE (Create)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas'
        ]);

        return redirect()->route('petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT (Form)
    |--------------------------------------------------------------------------
    */
    public function edit(User $petugas)
    {
        if ($petugas->role !== 'petugas') {
            abort(404);
        }

        return view('admin.petugas.edit', compact('petugas'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, User $petugas)
    {
        if ($petugas->role !== 'petugas') {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $petugas->id,
            'password' => 'nullable|min:6'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui');
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy(User $petugas)
    {
        if ($petugas->role !== 'petugas') {
            abort(404);
        }

        // Cegah hapus akun sendiri
        if (auth()->id() === $petugas->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $petugas->delete();

        return back()->with('success', 'Petugas berhasil dihapus');
    }
}