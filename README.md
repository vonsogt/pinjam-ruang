<p align="center">
  <h1 align="center">Pinjam Ruang</h1>
  
  <p align="center">
    Pinjam Ruang Mudah dan Cepat!
    <br />
    <a href="http://pinjam-ruang.batam-jasa.online/">Lihat Demo</a>
    ·
    <a href="https://github.com/vonsogt/pinjam-ruang/issues">Laporkan Kesalahan</a>
    ·
    <a href="https://github.com/vonsogt/pinjam-ruang/issues">Ajukan Fitur Baru</a>
  </p>
</p>

## Daftar Isi

* [Tentang Pinjam Ruang](#tentang-pinjam-ruang)
  * [Dibuat Menggunakan](#dibuat-menggunakan)
* [Demo](#demo)
* [Gambar](#gambar)
* [Fitur](#fitur)
* [Mulai](#mulai)
  * [Prasyarat](#prasyarat)
  * [Instalasi](#instalasi)
* [Petunjuk](#petunjuk)
* [Berkontribusi](#berkontribusi)
* [Lisensi](#lisensi)
* [Kontak](#kontak)

## Tentang pinjam-ruang

Pinjam Ruang merupakan sebuah aplikasi berbasis website yang bertujuan untuk mempermudah peminjaman ruangan pada suatu universitas/kampus.

### Dibuat Menggunakan
* [Laravel](https://laravel.com/)

## Demo

Tautan: http://pinjam-ruang.batam-jasa.online/admin

Akun: demo/demo123

## Gambar

Frontend:
![image](https://user-images.githubusercontent.com/35516476/129226360-d8185ae7-9163-4d04-a6d8-44df18e28704.png)
Backend:
![image](https://user-images.githubusercontent.com/35516476/129230321-60cd0f5c-d4ce-450b-a96a-e16411b358df.png)

## Fitur

BACKEND
- [x] Autentikasi
- [x] Aktor & Izin akses
- [x] Mahasiswa dapat melihat semua aktivitas peminjaman atas nama sendiri
- [x] Disisi backend mengecek user apakah username dan password masih sama, jika iya akan mengeluarkan info untuk "Ganti Password"

FRONTEND
- [x] Halaman utama website menampilkan flowchart tata cara peminjaman
- [X] Halaman utama memiliki menu navigasi menampikan ruangan yang sudah dibooking beserta detail lainnya (nama, tgl booking)
- [x] Mahasiswa dapat meminjam ruangan dengan mengisi
  - Nama Lengkap
  - Tanggal Mulai Pinjam
  - Tanggal Selesai Pinjam
  - Ruangan yang akan dipinjam
  - Dosen yang akan diminta persetujuan
  - NIM
  - Prodi
- [x] Mahasiswa tidak dapat meminjam ruangan yang sudah di booking pada tanggal ruangan yang sudah dibooking
  - Mahasiswa tidak dapat meminjam lebih dari 1 kali, jika peminjaman sebelumnya belum terselesaikan
- [x] Menampilkan detail peminjam, tanggal mulai dan tanggal selesai disetiap list ruangan
- [x] TU Jurusan IF bisa melihat semua status ruangan baik yang kosong maupun yang sudah dibooking. Kemudian TU juga bisa menyetujui ruangan yang sudah disetujui terlebih dahulu oleh Dosen. Jadi TU tidak akan menyetujui apabila belum ada persetujuan dari Dosen. Dan TU bisa mengubah status ruangan.
- [x] Dosen bisa melihat ruangan yang sudah direquest oleh mahasiswanya dan menyetujui melalui menu di aplikasi.


## Mulai

Sebelum melakukan instalasi proyek `pinjam-ruang` ada baiknya perhatikan hal-hal berikut ini:

### Prasyarat

Sebelum menggunakan projek ini, diperlukanya:
* [composer](https://getcomposer.org/)
* [php](https://www.php.net/downloads.php)
* [git](https://git-scm.com/)

### Instalasi

1. Unduh/Clone proyek ini
   ```git
   git clone https://github.com/vonsogt/pinjam-ruang.git
   ```
2. Lalu pindah ke direktori `pinjam-ruang`
   ```sh
   cd pinjam-ruang
   ```
3. Install komponen yang diperlukan menggunakan composer
   ```sh
   composer install
   ```
4. Copy file `.env.example` menjadi `.env`
   ```sh
   cp .env.example .env
   ```
5. Lalu generate `APP_KEY`
   ```sh
   php artisan key:generate
   ```
6. Lalu lakukan migrasi database dan query (isi database dari Polibatam)
   ```sh
   php artisan migrate:fresh --seed
   ```
7. Setelah berhasil, jalankan aplikasi
   ```sh
   php artisan serve
   ```
8. Lalu buka browser `127.0.0.1:8000` untuk menggunakan aplikasi
9. Selamat meminjam ruangan dengan mudah dan cepat 😊


## Petunjuk

Lihat [open issues](https://github.com/vonsogt/pinjam-ruang/issues) untuk daftar fitur yang diusulkan (dan masalah yang diketahui).

## Berkontribusi

Kontribusi adalah yang membuat komunitas open source menjadi tempat yang luar biasa untuk belajar, menginspirasi, dan berkreasi. Setiap kontribusi yang Anda berikan ** sangat dihargai **.

## Lisensi

`pinjam-ruang` berlisensi di bawah [MIT license](https://opensource.org/licenses/MIT).


## Kontak

Vonso - vonsogt18081999@gmail.com
