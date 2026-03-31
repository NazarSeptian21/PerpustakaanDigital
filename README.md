# 🚀 Perpustakaan Digital - UKK Nazar

[![Laravel](https://img.shields.io/badge/Laravel-11-green?logo=laravel)](https://laravel.com) [![Tailwind](https://img.shields.io/badge/TailwindCSS-v4-blue?logo=tailwind)](https://tailwindcss.com)

**Sistem Manajemen Perpustakaan Digital** dengan fitur lengkap untuk Admin, Petugas, & User.

## ✨ Fitur Pro
- ✅ **Multi Role**: Admin / Petugas / User
- ✅ **CRUD Lengkap**: Buku, Kategori, User, Peminjaman
- ✅ **Workflow Peminjaman**: Ajukan → Approve/Reject → Pengembalian
- ✅ **Management Stok Buku** (auto decrement/increment)
- ✅ **Review & Rating** buku (1-5 ⭐)
- ✅ **Koleksi Pribadi** user
- ✅ **Laporan PDF** (Buku & Peminjaman)
- ✅ **Activity Log** Observer
- ✅ **Responsive Design** Tailwind CSS v4 + Vite
- ✅ **SweetAlert2** UX
- ✅ **Search, Pagination, Validation**

## 🛠 Install (5 menit)
```bash
# Sudah di folder project_ukk_nazar
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

**Login Demo:**
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@test.com | password |
| Petugas | petugas@test.com | password |
| User | user@test.com | password |

## 📱 Akses Mobile
```
http://192.168.0.106:8000
```
Responsive full HP/PC!

## 🏗 Tech Stack
```
Laravel 11 + MySQL
Tailwind CSS v4 + Vite
SweetAlert2 + Lucide Icons
DomPDF + Laravel Observer
```

**Tugas Akhir UKK - Nilai A+ Ready!** 🎓

**Author:** Nazar  
**2026**

