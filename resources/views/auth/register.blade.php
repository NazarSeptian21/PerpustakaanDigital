@extends('layouts.app')

@section('title', 'Register')

@section('content')

{{-- ================= TOAST NOTIFICATION ERROR ================= --}}
@if (session('register_error'))

<div id="toast-error"
     class="fixed top-5 right-5 z-50 transform translate-x-full opacity-0 transition-all duration-500">

    <div class="bg-red-500 text-white px-6 py-4 rounded-xl shadow-xl flex items-center gap-3 min-w-[320px]">

        {{-- ICON --}}
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 flex-shrink-0"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"/>
        </svg>

        {{-- MESSAGE --}}
        <span class="font-semibold">
            {{ session('register_error') }}
        </span>

    </div>

</div>

@endif



<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 px-4">

    <form method="POST"
          action="{{ route('register') }}"
          class="bg-white w-full max-w-md p-10 rounded-2xl shadow-xl border border-gray-100">

        @csrf

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">
                Buat Akun
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                Daftar untuk mulai menggunakan perpustakaan
            </p>
        </div>


        {{-- VALIDATION ERROR --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-5">
                <ul class="text-sm list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- NAMA --}}
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-600">
                Nama Lengkap
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   class="w-full mt-2 px-4 py-3 border rounded-xl
                          focus:outline-none focus:ring-2 focus:ring-indigo-500
                          focus:border-indigo-500 transition">
        </div>


        {{-- EMAIL --}}
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-600">
                Email
            </label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   class="w-full mt-2 px-4 py-3 border rounded-xl
                          focus:outline-none focus:ring-2 focus:ring-indigo-500
                          focus:border-indigo-500 transition">
        </div>


        {{-- PASSWORD --}}
        <div class="mb-4 relative">

            <label class="text-sm font-semibold text-gray-600">
                Password
            </label>

            <input type="password"
                   name="password"
                   id="password"
                   required
                   class="w-full mt-2 px-4 py-3 border rounded-xl pr-12
                          focus:outline-none focus:ring-2 focus:ring-indigo-500
                          focus:border-indigo-500 transition">

            <button type="button"
                onclick="togglePass('password','slash1')"
                class="absolute right-4 top-[42px] text-gray-400 hover:text-indigo-600">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.477 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.065 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z"/>

                    <line id="slash1"
                          x1="4" y1="20"
                          x2="20" y2="4"
                          class="opacity-0 transition"/>
                </svg>

            </button>

        </div>


        {{-- KONFIRMASI PASSWORD --}}
        <div class="mb-6 relative">

            <label class="text-sm font-semibold text-gray-600">
                Konfirmasi Password
            </label>

            <input type="password"
                   name="password_confirmation"
                   id="password_confirm"
                   required
                   class="w-full mt-2 px-4 py-3 border rounded-xl pr-12
                          focus:outline-none focus:ring-2 focus:ring-indigo-500
                          focus:border-indigo-500 transition">

            <button type="button"
                onclick="togglePass('password_confirm','slash2')"
                class="absolute right-4 top-[42px] text-gray-400 hover:text-indigo-600">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.477 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.065 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z"/>

                    <line id="slash2"
                          x1="4" y1="20"
                          x2="20" y2="4"
                          class="opacity-0 transition"/>
                </svg>

            </button>

        </div>


        {{-- BUTTON --}}
        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white
                   py-3 rounded-xl font-semibold shadow-md transition">
            Register
        </button>

        {{-- BUTTON KEMBALI --}}
<a href="{{ url('/') }}"
   class="block w-full text-center mt-3
          bg-gray-200 hover:bg-gray-300 text-gray-700
          py-3 rounded-xl font-semibold transition">

    ← Kembali

</a>


        {{-- LOGIN LINK --}}
        <p class="text-center text-sm text-gray-500 mt-6">

            Sudah punya akun?

            <a href="{{ route('login') }}"
               class="text-indigo-600 font-semibold hover:underline">
               Login
            </a>

        </p>

    </form>

</div>



{{-- SCRIPT TOAST --}}
<script>

document.addEventListener("DOMContentLoaded", function() {

    const toast = document.getElementById("toast-error");

    if (toast)
    {
        setTimeout(() => {
            toast.classList.remove("translate-x-full", "opacity-0");
        }, 100);

        setTimeout(() => {

            toast.classList.add("translate-x-full", "opacity-0");

            setTimeout(() => {
                toast.remove();
            }, 500);

        }, 4000);
    }

});



function togglePass(inputId, slashId)
{
    const input = document.getElementById(inputId);
    const slash = document.getElementById(slashId);

    if (input.type === "password")
    {
        input.type = "text";
        slash.classList.remove("opacity-0");
        slash.classList.add("opacity-100");
    }
    else
    {
        input.type = "password";
        slash.classList.remove("opacity-100");
        slash.classList.add("opacity-0");
    }
}

</script>

@endsection
