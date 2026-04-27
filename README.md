# 🕌 UmrohQueens - Agregator Travel Umroh Terpercaya

![UmrohQueens Banner](https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?q=80&w=2070&auto=format&fit=crop)

**UmrohQueens** adalah platform aggregator travel umroh modern yang dibangun dengan CodeIgniter 4. Platform ini memudahkan calon jamaah untuk membandingkan paket umroh dari berbagai travel agent terpercaya dengan bantuan teknologi AI.

---

## ✨ Fitur Unggulan

- 🤖 **AI Umrah Assistant**: Cari paket impian menggunakan bahasa natural.
- 🔍 **Advanced Filtering**: Filter berdasarkan harga, durasi, bintang hotel, dan maskapai.
- 📊 **Real-time Quota**: Informasi sisa kursi yang diperbarui secara instan.
- 📱 **Jamaah Dashboard**: Kelola booking, dokumen (KTP/Paspor), dan pembayaran dalam satu tempat.
- 🎨 **Premium UI**: Desain elegan bertema *Emerald Green & Gold* yang responsif.

---

## 🛠️ Persyaratan Sistem

- **PHP**: ^8.2
- **Database**: MySQL / MariaDB
- **Composer**: Terinstal di sistem
- **Web Server**: Apache/Nginx atau gunakan PHP built-in server

---

## 🚀 Panduan Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan project di lokal Anda:

### 1. Clone Repositori
Buka terminal dan jalankan perintah berikut:
```bash
git clone https://github.com/dindaayyr/project-web.git
cd project-web
```

### 2. Instal Dependensi
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file `env` menjadi `.env`:
```bash
cp env .env
```
Buka file `.env` dan pastikan pengaturan database Anda sudah benar (hostname, username, password).

### 4. Setup Database Otomatis
Jalankan perintah kustom kami untuk membuat database, tabel, dan mengisi data dummy sekaligus:
```bash
php spark db:setup
```

### 5. Jalankan Aplikasi
```bash
php spark serve
```
Aplikasi dapat diakses melalui browser di: `http://localhost:8080`

---

## 🤝 Panduan Kolaborasi

Kami menyambut baik kontribusi Anda! Berikut adalah alur kolaborasi di repo ini:

### Alur Kerja (Workflow)
1. **Fork/Clone**: Ambil salinan terbaru dari branch `main`.
2. **Feature Branch**: Buat branch baru untuk setiap fitur atau perbaikan bug.
   ```bash
   git checkout -b fitur/nama-fitur
   ```
3. **Commit**: Gunakan pesan commit yang deskriptif.
   ```bash
   git commit -m "Add: Integrasi API Pembayaran"
   ```
4. **Push**: Kirim perubahan ke repositori.
   ```bash
   git push origin fitur/nama-fitur
   ```
5. **Pull Request**: Buka PR ke branch `main` dengan penjelasan mengenai perubahan yang Anda lakukan.

### Aturan Coding
- Ikuti standar PSR-12 untuk penulisan kode PHP.
- Pastikan setiap fitur baru memiliki dokumentasi singkat di dalam kode.
- Jangan mengunggah file sensitif (seperti `.env`) ke repositori.

---

## 👤 Akun Uji Coba (Demo)
Setelah menjalankan `php spark db:setup`, Anda dapat login menggunakan:
- **Email**: `admin@umrohqueens.com`
- **Password**: `password123`

---

## 📦 Data Katalog Paket
Seluruh daftar paket umroh yang muncul di halaman **Katalog** dikelola melalui database. Teman Anda akan mendapatkan list paket yang sama persis setelah menjalankan seeder:
- **Lokasi File Data**: `app/Database/Seeds/DatabaseSeeder.php`
- **Cara Update**: Ubah data di file tersebut, lalu jalankan `php spark db:setup`.

---

## 📄 Lisensi
Project ini dikembangkan untuk tujuan agregasi travel umroh eksklusif. Hak cipta © 2026 **UmrohQueens**.

---