<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<form method="POST" action="{{ route('login') }}"
      class="bg-white p-8 rounded-xl shadow w-96">
    @csrf

    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    @error('email')
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
            {{ $message }}
        </div>
    @enderror

    <!-- EMAIL -->
    <input type="email" name="email" placeholder="Email"
        class="w-full mb-4 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required>

    <!-- PASSWORD -->
    <div class="relative mb-6">
        <input
            type="password"
            name="password"
            id="password"
            placeholder="Password"
            class="w-full px-4 py-2 border rounded-lg pr-12 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
        >

        <!-- TOGGLE BUTTON -->
        <button
            type="button"
            onclick="togglePassword()"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-indigo-600"
            aria-label="Toggle password visibility"
        >
            <!-- EYE ICON -->
            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                         -1.274 4.057-5.064 7-9.542 7
                         -4.477 0-8.268-2.943-9.542-7z" />
            </svg>

            <!-- EYE OFF ICON -->
            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 hidden"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19
                         c-4.478 0-8.268-2.943-9.542-7
                         a9.956 9.956 0 012.223-3.592M6.223 6.223
                         A9.956 9.956 0 0112 5
                         c4.478 0 8.268 2.943 9.542 7
                         a9.956 9.956 0 01-4.293 5.133M15 12
                         a3 3 0 00-3-3m0 0a3 3 0 013 3m-3-3
                         L3 3m18 18L9 9" />
            </svg>
        </button>
    </div>

    <!-- BUTTON -->
    <button type="submit"
        class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
        Login
    </button>

    {{-- BUTTON KEMBALI --}}
<a href="{{ url('/') }}"
   class="block w-full text-center mt-3
          bg-gray-200 hover:bg-gray-300 text-gray-700
          py-3 rounded-xl font-semibold transition">

    ← Kembali

</a>
</form>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (password.type === 'password') {
            password.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            password.type = 'password';
            eyeClosed.classList.add('hidden');
            eyeOpen.classList.remove('hidden');
        }
    }
</script>

</body>
</html>
