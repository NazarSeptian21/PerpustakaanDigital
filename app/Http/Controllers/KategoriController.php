<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query();

        // SEARCH
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $kategori = $query->latest()->paginate(10);

        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama'
        ]);

        Kategori::create([
            'nama' => $request->nama
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $this->authorizeAdmin();

        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama,' . $id
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama' => $request->nama
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();

        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }

    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }
    }
}