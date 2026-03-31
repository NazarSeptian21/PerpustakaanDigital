@extends('layouts.app')


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
        .glass { backdrop-filter: blur(14px); background: rgba(255,255,255,0.7); }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            transition: all .25s ease;
        }
        .btn-primary:hover { transform: translateY(-2px) scale(1.03); }
        .btn-primary:active { transform: scale(.95); }

        .btn-outline {
            transition: all .25s ease;
        }
        .btn-outline:hover { transform: translateY(-2px); }
        .btn-outline:active { transform: scale(.95); }

        .book-card {
            transition: transform .25s ease, box-shadow .25s ease;
            cursor: pointer;
        }
        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,.15);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 min-h-screen overflow-x-hidden">

<!-- NAVBAR -->
<nav class="fixed top-0 w-full z-50">
    <div class="glass border-b border-white/40">
        <div class="max-w-7xl mx-auto px-10 h-20 flex items-center justify-between">

            <!-- LOGO -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                    <i data-lucide="book-open" class="w-5 h-5"></i>
                </div>
                <span class="text-xl font-extrabold text-indigo-700">
                    Perpustakaan Digital
                </span>
            </div>

            <!-- MENU -->
            <ul class="hidden md:flex gap-10 font-medium">
                <li><a href="{{ route('landing') }}" class="text-indigo-700">Home</a></li>
                <li><a href="{{ route('about') }}" class="text-slate-600 hover:text-indigo-600">About</a></li>
                <li><a href="{{ route('contact') }}" class="text-slate-600 hover:text-indigo-600">Contact</a></li>
            </ul>

            <!-- ACTION -->
            <div class="flex items-center gap-4">

                {{-- GUEST --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="btn-outline px-6 py-2.5 rounded-2xl border border-indigo-600 text-indigo-600 font-semibold">
                        Masuk
                    </a>

                    <a href="{{ route('register') }}"
                       class="btn-primary text-white px-6 py-2.5 rounded-2xl shadow-lg">
                        Register
                    </a>
                @endguest

                {{-- AUTH --}}
                @auth
                    <a href="{{ optional(auth()->user())->role === 'admin'
                                ? route('dashboard.admin')
                                : route('dashboard.user') }}"
                       class="btn-primary text-white px-6 py-2.5 rounded-2xl shadow-lg">
                        Dashboard
                    </a>

                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit"
            onclick="confirmLogout()"
            class="btn-outline px-6 py-2.5 rounded-2xl border border-red-500 text-red-500 font-semibold hover:bg-red-500 hover:text-white transition">
        Logout
    </button>
</form>
                @endauth

            </div>

        </div>
    </div>
</nav>

<!-- HERO -->
<section class="pt-40 pb-28">
    <div class="max-w-7xl mx-auto px-10 grid md:grid-cols-2 gap-20 items-center">

        <div>
            <span class="inline-flex items-center gap-2 mb-6 px-5 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold">
                <i data-lucide="book-open" class="w-4 h-4"></i>
                Perpustakaan Digital Generasi Baru
            </span>

            <h1 class="text-5xl font-extrabold leading-tight text-slate-900 mb-6">
                Temukan Ilmu,<br>
<span style="background: linear-gradient(to right, #2563eb, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: bold; font-size: 3.5rem;">
        Perluas Wawasan
    </span>
            </h1>

            <p class="text-slate-600 text-lg mb-10 max-w-xl">
                Akses ribuan koleksi buku digital berkualitas dengan pengalaman membaca modern.
            </p>

            <a href="#koleksi"
               class="btn-primary text-white px-8 py-4 rounded-2xl font-semibold shadow-xl">
                Jelajahi Koleksi
            </a>
        </div>

        <div class="relative flex justify-center">
            <div class="absolute -top-12 -right-12 w-[320px] h-[320px] bg-indigo-300 rounded-full blur-3xl opacity-40"></div>
            <img src="{{ asset('images/hore2.png') }}"
                 class="relative w-full max-w-md">
        </div>

    </div>
</section>

<!-- KOLEKSI -->
<section id="koleksi" class="py-28 bg-gradient-to-b from-indigo-50 to-white">
    <div class="max-w-7xl mx-auto px-10">

        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-indigo-700 mb-4">
                Koleksi Buku Digital
            </h2>
            <p class="text-slate-600">
                Jelajahi berbagai koleksi buku digital kami
            </p>
        </div>

        @php
            $books = [
                ['img'=>'buku1.jpeg','title'=>'Tanaman Karet','author'=>'KST Al Endy, S.Pd., M.Pd'],
                ['img'=>'buku2.jpeg','title'=>'Revolusi Kemerdekaan Indonesia','author'=>'Hermawan Dwi Putro'],
                ['img'=>'buku3.jpeg','title'=>'English For Business','author'=>'Imas Wahyu Agustina'],
                ['img'=>'buku11.jpeg','title'=>'Bumi Manusia','author'=>'Pramoedya Ananta Toer'],
                ['img'=>'buku15.jpeg','title'=>'Gadis Kretek','author'=>'Ratih Kumala'],
            ];
        @endphp

        <div class="flex gap-6 overflow-x-auto pb-6">
            @foreach ($books as $book)
                <div class="book-card min-w-[220px] bg-white rounded-2xl p-4">
                    <img src="{{ asset('images/'.$book['img']) }}"
                         class="rounded-xl mb-4 h-auto max-h-64 w-full object-cover">
                    <h3 class="font-semibold text-slate-800 leading-tight">
                        {{ $book['title'] }}
                    </h3>
                    <p class="text-sm text-slate-500">
                        {{ $book['author'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-14 text-center">
            <a href="{{ route('books.index') }}"
               class="inline-flex items-center gap-2 btn-primary text-white px-10 py-4 rounded-2xl font-semibold shadow-xl">
                Lihat Semua Koleksi
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>

    </div>
</section>

<footer class="bg-slate-900 text-slate-400 py-12">
    <div class="max-w-7xl mx-auto px-10 text-center">
        © 2026 Perpustakaan Digital
    </div>
</footer>

<script>
    lucide.createIcons();
</script>

</body>
</html>
