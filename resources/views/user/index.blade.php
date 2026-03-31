<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto py-10 px-6">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Data Pengguna
        </h1>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow border overflow-hidden">

        <!-- TABLE -->
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">No</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Nama</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Email</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach($users as $index => $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-700">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $user->email }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- JIKA KOSONG -->
        @if($users->isEmpty())
        <div class="p-8 text-center text-gray-500">
            Belum ada pengguna.
        </div>
        @endif

    </div>

    <!-- BUTTON KEMBALI (KIRI BAWAH) -->
    <div class="mt-6 flex justify-start">
        <a href="{{ route('dashboard.admin') }}"
           class="bg-indigo-600 text-white px-5 py-2 rounded-xl shadow hover:bg-indigo-700 transition">
            ← Kembali
        </a>
    </div>

</div>

</body>
</html>
