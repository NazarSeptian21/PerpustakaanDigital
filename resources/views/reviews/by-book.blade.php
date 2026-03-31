<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ulasan Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto py-10 px-6">

    <!-- HEADER -->
    <h1 class="text-3xl font-bold text-gray-800 mb-2">
        Ulasan Buku
    </h1>
    <p class="text-gray-600 mb-8">
        {{ $book->title }}
    </p>

    <!-- LIST ULASAN -->
    <div class="space-y-6">

        @forelse($reviews as $review)
        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex justify-between mb-2">
                <h3 class="font-semibold text-gray-800">
                    {{ $review->user->name }}
                </h3>

                <span class="text-yellow-500 font-semibold">
                    ⭐ {{ $review->rating }}
                </span>
            </div>

            <p class="text-gray-600">
                {{ $review->comment }}
            </p>

        </div>
        @empty
        <div class="bg-white rounded-2xl shadow border p-8 text-center text-gray-500">
            Belum ada ulasan untuk buku ini.
        </div>
        @endforelse

    </div>

    <!-- BUTTON KEMBALI -->
    <div class="mt-8">
        <a href="{{ route('dashboard.admin') }}"
           class="bg-indigo-600 text-white px-5 py-2 rounded-xl shadow hover:bg-indigo-700 transition">
            ← Kembali
        </a>
    </div>

</div>

</body>
</html>
