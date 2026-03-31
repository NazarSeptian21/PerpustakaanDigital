<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori'; // JANGAN kategoris

    protected $fillable = [
        'nama'
    ];

    // RELASI KE BUKU
    public function books()
    {
        return $this->hasMany(Book::class, 'kategori_id');
    }
}
