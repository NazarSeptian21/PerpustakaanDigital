<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN FORM REGISTER
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES REGISTER
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        try {

            // ================= BLOK AKUN PETUGAS =================
            if ($request->email === 'petugas@gmail.com') {

                return back()
                    ->with('register_error', 'Akun petugas tidak bisa dibuat dari halaman register!')
                    ->withInput();
            }


            // ================= VALIDASI =================
            $request->validate([
                'name' => 'required|string|max:255',

                'email' => 'required|email|unique:users,email',

                'password' => 'required|min:6|confirmed',
            ]);


            // ================= TENTUKAN ROLE =================
            $role = 'user';

            if ($request->email === 'admin@gmail.com') {
                $role = 'admin';
            }


            // ================= SIMPAN USER =================
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
            ]);


            // ================= LOGIN OTOMATIS =================
            Auth::login($user);


            // ================= REDIRECT SESUAI ROLE =================
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            }

            if ($user->role === 'petugas') {
                return redirect()->route('dashboard.petugas');
            }

            return redirect()->route('dashboard.user');


        } catch (Exception $e) {

            // ================= ERROR SISTEM =================
            return back()
                ->with('register_error', 'Terjadi kesalahan, silakan coba lagi.')
                ->withInput();
        }
    }
}
