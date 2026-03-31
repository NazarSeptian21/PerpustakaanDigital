<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Book;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Field yang boleh di-insert massal
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Field yang disembunyikan saat serialize
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi Koleksi Pribadi
     * User bisa punya banyak buku di koleksi
     */
    public function koleksiBuku(): BelongsToMany
    {
        return $this->belongsToMany(
            Book::class,          // model tujuan
            'koleksipribadi',     // nama tabel pivot
            'user_id',            // foreign key di pivot untuk user
            'book_id'             // foreign key di pivot untuk book
        )->withTimestamps();
    }
}
