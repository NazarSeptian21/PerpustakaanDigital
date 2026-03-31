<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
    'judul',
    'penulis',
    'kategori_id',
    'stok',
    'cover',
    'isbn',
    'penerbit',
    'tahun_terbit',
];
    // RELASI KE KATEGORI
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // RELASI KE REVIEW (opsional tapi bagus)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
