
# Pelaporan dan Pemantauan Keamanan Makanan MBG
 
Aplikasi web untuk membantu masyarakat melaporkan dugaan gangguan kesehatan setelah konsumsi makanan MBG, serta memantau peninjauan dan penerusan laporan oleh Pemantau dan Koordinator Komunitas.
 
Dibuat sebagai Mini Project Proyek 3, Program Studi D3 Teknik Informatika, Jurusan Teknik Komputer dan Informatika, Politeknik Negeri Bandung.
 
## Identitas Mahasiswa
 
| Item | Keterangan |
|---|---|
| Nama | Ahmad Aisy Fathryan Siswandar |
| NIM | 251511033 |
| Kelas | 2B - D3 |
| Judul | Sistem Pelaporan dan Pemantauan Keamanan Makanan MBG (Kasus A) |
| URL Repository | https://github.com/imissmysoup/Proyek-3-Mini-Project |
 
## Kebutuhan Environment
 
| Komponen | Versi |
|---|---|
| PHP | 8.3 atau lebih baru |
| Composer | 2.x |
| Node.js dan npm | Node.js 20 atau lebih baru |
| MySQL atau MariaDB | MySQL 8.0 atau MariaDB 10.6 atau lebih baru |
| Git | Bebas |
 
Ekstensi PHP yang dibutuhkan: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`.
 
## Langkah Instalasi
 
1. Clone repository:
```bash
   git clone https://github.com/imissmysoup/Proyek-3-Mini-Project.git
   cd Proyek-3-Mini-Project/mbg-pelaporan
```
 
2. Instal dependensi PHP dan JavaScript:
```bash
   composer install
   npm install
```
 
3. Salin file environment dan buat application key:
```bash
   cp .env.example .env
   php artisan key:generate
```
 
   Di Windows (Command Prompt), gunakan `copy .env.example .env`.
 
4. Atur koneksi database pada file `.env` (lihat bagian Konfigurasi Database di bawah).
5. Jalankan migration dan seeder:
```bash
   php artisan migrate --seed
```
 
6. Buat symbolic link untuk folder storage (diperlukan agar file bukti dapat dilihat):
```bash
   php artisan storage:link
```
 
7. Build asset frontend:
```bash
   npm run build
```
 
   Atau jalankan mode development dengan `npm run dev`.
 
## Konfigurasi Database
 
Buat database kosong terlebih dahulu, misalnya `mbg_pelaporan`, lalu isi bagian berikut di `.env`:
 
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mbg_pelaporan
DB_USERNAME=root
DB_PASSWORD=isi_password_database_kamu
```
 
File `.env` tidak diunggah ke repository. Setiap pengguna harus membuat file `.env` sendiri dari `.env.example`.
 
Catatan: `.env.example` secara default menggunakan SQLite. Jika ingin memakai SQLite, buat file `database/database.sqlite` dan ubah `DB_CONNECTION=sqlite`.
 
## Migration dan Seeding
 
| Perintah | Fungsi |
|---|---|
| `php artisan migrate` | Membuat seluruh tabel |
| `php artisan migrate --seed` | Membuat tabel lalu mengisi data demo |
| `php artisan migrate:fresh --seed` | Menghapus seluruh tabel lalu membuat ulang dan mengisi data demo. Seluruh data akan hilang. |
 
Seeder membuat:
- 3 akun demo, satu untuk setiap role
- 2 sekolah: SMP Harapan dan SD Nusantara
- 3 distribusi (dua untuk SMP Harapan, satu untuk SD Nusantara)
Untuk pengujian yang lebih lengkap, tambahkan laporan demo dalam berbagai status melalui tinker atau halaman aplikasi.
 
## Akun Demo
 
Semua akun menggunakan password: `password`
 
| Role | Email | Hak akses utama |
|---|---|---|
| Pelapor | pelapor@demo.com | Membuat laporan, melihat dan memperbaiki laporan miliknya sendiri selama status Menunggu Tinjauan |
| Pemantau Komunitas | pemantau@demo.com | Melihat seluruh laporan, meninjau dan memberi catatan, mengubah status tahap peninjauan, melihat rekap |
| Koordinator Komunitas | koordinator@demo.com | Melihat seluruh laporan, mencatat penerusan dan menyelesaikan laporan, melihat rekap |
 
Akun demo hanya untuk pengujian lokal. Ganti password sebelum aplikasi digunakan di tempat lain.
 
## Cara Menjalankan Aplikasi
 
1. Jalankan server Laravel:
```bash
   php artisan serve
```
 
2. Buka `http://127.0.0.1:8000` di browser.
3. Login menggunakan salah satu akun demo di atas.
4. Setelah login, pengguna diarahkan ke daftar laporan di `/laporan`.
Untuk menghentikan server, tekan `Ctrl+C`.
 
## Struktur Singkat
 
| Lokasi | Isi |
|---|---|
| `app/Http/Controllers` | AuthController, LaporanController, RekapController |
| `app/Http/Requests` | StoreLaporanRequest (validasi laporan dan bukti) |
| `app/Models` | Sekolah, Distribusi, Laporan, AuditLog, User |
| `app/Observers` | LaporanObserver (mencatat perubahan status) |
| `database/migrations` | Struktur tabel |
| `database/seeders` | Data demo |
| `resources/views` | Tampilan Blade |
| `routes/web.php` | Definisi route |
 
## Pengujian
 
Acceptance Criteria yang digunakan untuk pengujian peer ada pada laporan mini project. Untuk menjalankan test otomatis:
 
```bash
php artisan test
```
 
## Lisensi
 
Repository ini dibuat untuk keperluan tugas kuliah. Framework Laravel menggunakan lisensi MIT.