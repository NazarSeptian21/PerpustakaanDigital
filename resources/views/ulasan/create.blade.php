@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 flex items-center justify-center">

<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-xl">

<h2 class="text-2xl font-bold text-gray-800 mb-6">
Beri Ulasan Buku
</h2>

<div class="mb-4">
<p class="text-sm text-gray-500">Judul Buku</p>
<p class="font-semibold text-lg">{{ $book->judul }}</p>
</div>

<form action="{{ route('ulasan.store') }}" method="POST">
@csrf

<input type="hidden" name="book_id" value="{{ $book->id }}">

{{-- Rating --}}
<div class="mb-4">
<label class="block text-sm font-semibold mb-2">Rating</label>

<select name="rating"
class="w-full border rounded-lg px-3 py-2">
<option value="5">⭐⭐⭐⭐⭐ Sangat Bagus</option>
<option value="4">⭐⭐⭐⭐ Bagus</option>
<option value="3">⭐⭐⭐ Lumayan</option>
<option value="2">⭐⭐ Kurang</option>
<option value="1">⭐ Buruk</option>
</select>

</div>

{{-- Komentar --}}
<div class="mb-6">
<label class="block text-sm font-semibold mb-2">Komentar</label>

<textarea
name="komentar"
rows="4"
class="w-full border rounded-lg px-3 py-2"
placeholder="Tulis ulasan anda..."></textarea>

</div>

<div class="flex justify-between">

<a href="{{ route('peminjaman.index') }}"
class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
Kembali
</a>

<button
class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
Kirim Ulasan
</button>

</div>

</form>

</div>
</div>

@endsection