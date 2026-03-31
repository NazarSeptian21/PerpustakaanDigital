<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ulasan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto py-12 px-6">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">
        Tambah Ulasan Buku
    </h1>

    <div class="bg-white rounded-2xl shadow border p-8">

        <form action="{{ route('review.store') }}" method="POST" class="space-y-6">
            @csrf

        @if(isset($book))

<input type="hidden" name="book_id" value="{{ $book->id }}">

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700">
        Buku
    </label>
    <p class="mt-1 text-gray-800 font-medium">
        {{ $book->judul }}
    </p>
</div>

@else

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700">
        Pilih Buku
    </label>

    <select name="book_id"
        class="w-full border rounded-lg px-3 py-2 mt-1">
        @foreach($books as $b)
            <option value="{{ $b->id }}">
                {{ $b->judul }}
            </option>
        @endforeach
    </select>
</div>

@endif

            <!-- RATING -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">
                    Rating
                </label>
                <div>

<div class="flex gap-2" id="starRating">

@for($i=1;$i<=5;$i++)
<svg data-value="{{ $i }}"
class="star w-8 h-8 cursor-pointer text-gray-300 hover:text-yellow-400"
fill="currentColor"
viewBox="0 0 24 24">

<path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828
1.548 8.278L12 18.896l-7.484 4.516
1.548-8.278L0 9.306l8.332-1.151z"/>

</svg>
@endfor

</div>

<input type="hidden" name="rating" id="ratingValue" required>

</div>
                 

            <!-- KOMENTAR -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">
                    Komentar
                </label>
                <textarea name="comment" rows="4"
                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none"
                    required></textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:bg-indigo-700 transition font-semibold">
                    Simpan Ulasan
                </button>

                <a href="{{ route('reviews.index') }}"
                   class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-300 transition font-semibold">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>


<script>

const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('ratingValue');

stars.forEach((star, index) => {

star.addEventListener('click', () => {

const rating = star.getAttribute('data-value');

ratingInput.value = rating;

stars.forEach((s, i) => {

if(i < rating){
s.classList.remove('text-gray-300');
s.classList.add('text-yellow-400');
}else{
s.classList.remove('text-yellow-400');
s.classList.add('text-gray-300');
}

});

});

});

</script>

</body>
</html>
