<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    // proses kirim email (atau logika lain)

    return redirect()->back()->with(
        'success',
        'Pesan Anda berhasil terkirim. Terima kasih telah menghubungi kami.'
    );
}

}
