# Readora – Aplikasi Toko E-Book Digital

Readora adalah aplikasi toko e-book digital berbasis web yang dibangun menggunakan **Laravel**. Aplikasi ini memungkinkan pengguna untuk menjelajahi katalog buku, melakukan pembelian melalui **Midtrans Payment Gateway**, serta membaca e-book dalam format PDF secara aman langsung di browser.

## Tech Stack

- Backend: Laravel (PHP)
- Frontend: Blade Template, Bootstrap, CSS & JavaScript
- Database: MySQL
- Payment Gateway: Midtrans
- PDF Viewer: PDF.js

## Menjalankan proyek

```bash
composer install
npm install
npm run build
php artisan migrate --seed
php artisan serve
```

## Fitur utama

- Autentikasi pengguna (register, login, dan session management).
- Katalog buku digital dengan kategori dan pencarian.
- Keranjang belanja dan wishlist.
- Integrasi pembayaran menggunakan Midtrans.
- Perpustakaan digital untuk buku yang telah dibeli.
- PDF reader terintegrasi untuk membaca e-book di browser.
- Manajemen profil pengguna dan riwayat transaksi.
- Desain responsif dan user-friendly.

## Alur kerja aplikasi

1. **Autentikasi & Akses Pengguna**
   - Pengguna dapat melakukan registrasi dan login.
   - Sistem autentikasi dikelola oleh Laravel dengan session dan middleware.
   - Halaman tertentu (library, checkout, reader) hanya dapat diakses oleh pengguna yang sudah login.

2. **Katalog & Pencarian Buku**
   - Data buku diambil dari database MySQL melalui Eloquent ORM.
   - Pengguna dapat melihat daftar buku, detail buku, serta melakukan pencarian berdasarkan judul atau kategori.

3. **Keranjang & Wishlist**
   - Buku dapat ditambahkan ke keranjang belanja atau wishlist.
   - Data keranjang disimpan di session pengguna hingga proses checkout dilakukan.

4. **Proses Pembayaran**
   - Checkout akan memanggil Midtrans Payment Gateway.
   - Sistem mengirim detail transaksi (ID pesanan, total harga, dan data pengguna).
   - Status pembayaran diperbarui berdasarkan response dari Midtrans.

5. **Perpustakaan Digital**
   - Setelah pembayaran berhasil, buku otomatis masuk ke library pengguna.
   - Pengguna hanya dapat mengakses dan membaca buku yang telah dibeli.

6. **PDF Reader**
   - File PDF disimpan secara aman di server.
   - Akses file divalidasi berdasarkan kepemilikan pengguna.
   - PDF ditampilkan menggunakan PDF.js di dalam browser.

7. **Manajemen Profil & Riwayat**
   - Pengguna dapat melihat riwayat pembelian.
   - Pengguna dapat memperbarui data profil dan pengaturan akun.

## Struktur penting

- `app/Http/Controllers/` – Mengatur logika aplikasi dan alur data.
- `app/Models/` – Representasi tabel database menggunakan Eloquent.
- `resources/views/` – Blade templates untuk tampilan UI.
- `database/migrations/` – Struktur database.
- `database/seeders/` – Data awal untuk testing.

## Keamanan Aplikasi

- Middleware untuk membatasi akses halaman tertentu.
- Validasi input pada sisi server.
- Penyimpanan file PDF secara private.
- Proteksi CSRF pada seluruh form.

## Pengembangan lanjutan

Beberapa fitur yang dapat dikembangkan ke depannya:

1. Sistem rating dan ulasan buku.
2. Filter dan sorting katalog buku.
3. Notifikasi email setelah transaksi.
4. Sinkronisasi akun multi-perangkat.
5. Dashboard admin untuk laporan penjualan.
