<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // 🔍 Search nama atau email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()
                       ->paginate(10)
                       ->withQueryString();

        return view('admin.users.index', compact('users'));
    }
    public function destroy($id)
{
    $user = User::findOrFail($id);

    $user->delete();

    return redirect()->route('users.index')
                     ->with('success', 'User berhasil dihapus.');
}
}