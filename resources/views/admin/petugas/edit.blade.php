@extends('layouts.app')

@section('title','Edit Petugas')

@section('content')

<div class="p-6 max-w-3xl mx-auto">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Petugas
        </h1>
        <p class="text-gray-500 mt-1">
            Perbarui data akun petugas
        </p>
    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">

        <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-5">
                <label class="block mb-2 font-semibold text-gray-700">
                    Nama
                </label>
                <input type="text" name="name"
                    value="{{ old('name', $petugas->name) }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label class="block mb-2 font-semibold text-gray-700">
                    Email
                </label>
                <input type="email" name="email"
                    value="{{ old('email', $petugas->email) }}"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>
            </div>

            {{-- Password Optional --}}
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">
                    Password (Kosongkan jika tidak diubah)
                </label>

                <div class="relative">
                    <input type="password"
                           name="password"
                           id="passwordEdit"
                           class="w-full border rounded-xl px-4 py-3 pr-12
                                  focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    {{-- BUTTON ICON MATA --}}
                    <button type="button"
                            onclick="togglePasswordEdit()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-indigo-600 transition">

                        {{-- ICON MATA TERBUKA --}}
                        <svg id="eyeOpenEdit" xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                                     c4.477 0 8.268 2.943 9.542 7
                                     -1.274 4.057-5.065 7-9.542 7
                                     -4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        {{-- ICON MATA TERTUTUP --}}
                        <svg id="eyeCloseEdit" xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 hidden"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13.875 18.825A10.05 10.05 0 0112 19
                                     c-4.477 0-8.268-2.943-9.542-7
                                     a9.956 9.956 0 012.223-3.592"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.18 6.18A9.956 9.956 0 0112 5
                                     c4.477 0 8.268 2.943 9.542 7
                                     a9.956 9.956 0 01-4.132 5.411"/>
                            <line x1="3" y1="3" x2="21" y2="21"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>

                    </button>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('petugas.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl shadow">
                    ← Kembali
                </a>

                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow font-semibold">
                    Update
                </button>
            </div>

        </form>

    </div>

</div>

{{-- SCRIPT TOGGLE PASSWORD --}}
<script>
function togglePasswordEdit() {
    const password = document.getElementById("passwordEdit");
    const eyeOpen = document.getElementById("eyeOpenEdit");
    const eyeClose = document.getElementById("eyeCloseEdit");

    if (password.type === "password") {
        password.type = "text";
        eyeOpen.classList.add("hidden");
        eyeClose.classList.remove("hidden");
    } else {
        password.type = "password";
        eyeOpen.classList.remove("hidden");
        eyeClose.classList.add("hidden");
    }
}
</script>

@endsection