# Aplikasi Inventaris Buku (CodeIgniter 4 + Bootstrap 5 + MySQL)

Aplikasi web sederhana untuk mencatat koleksi buku: judul, penulis, tahun terbit, dan kategori.
Fitur: CRUD lengkap, validasi, pesan sukses, konfirmasi hapus, pencarian, pagination, tampilan responsif.

## Identitas Mahasiswa

- **NIM:** 240631100010
- **Nama:** Moh Habib Azka Alawi Saekhon D

> **Penting:** paket ini berisi kode aplikasi (folder `app/`), file database, dan konfigurasi.
> Framework CodeIgniter 4 **tidak ikut dibundel** dan diunduh lewat Composer pada langkah 2 (resmi, ±1 menit).
> Bootstrap 5 dimuat lewat CDN (jsDelivr), jadi perlu koneksi internet saat membuka aplikasi.

## 1. Kebutuhan Sistem

- **[Laragon](https://laragon.org/download/)** (disarankan versi *Full*). Sudah termasuk PHP 8.1+ (ekstensi `intl`, `mbstring`, `mysqlnd`, `curl`, `json` aktif), Apache/Nginx, MySQL/MariaDB, Composer, Git, dan HeidiSQL.
- Pastikan Laragon sudah dijalankan (**Start All**) sebelum mengikuti langkah di bawah.

> Jika `intl` belum aktif: klik kanan ikon Laragon → **PHP → Extensions → intl**, lalu Laragon akan me-restart Apache.

## 2. Instalasi (Laragon)

**a. Buat proyek CodeIgniter 4 di folder `www` Laragon dan salin kode aplikasi**

Klik kanan ikon Laragon → **Terminal**, lalu:

```bash
cd C:\laragon\www
composer create-project codeigniter4/appstarter inventaris-buku
```

Ekstrak zip ini, lalu **salin isinya ke dalam `C:\laragon\www\inventaris-buku`** dan pilih *Replace/Timpa*
jika ditanya (folder `app/` akan ditimpa file `Routes.php`, controller, model, dan view milik aplikasi ini).

Hasil akhirnya:

```
C:\laragon\www\inventaris-buku\
├── app/
│   ├── Config/Routes.php            <- routing aplikasi
│   ├── Controllers/Home.php, Buku.php
│   ├── Models/BukuModel.php
│   └── Views/ (layout/main.php, home.php, buku/*.php)
├── database/inventaris_buku.sql     <- ekspor database
├── .env.example
├── README.md
└── (vendor/, public/, system, dll. dari CodeIgniter)
```

**b. Impor database**

Cara HeidiSQL (bawaan Laragon): klik **Database** di jendela Laragon → login (user `root`, password kosong) →
menu **File → Run SQL file...** → pilih `database/inventaris_buku.sql` → **Open**.
(File ini sudah membuat database `inventaris_buku`, tabel `buku`, dan 12 data contoh.)

Cara Terminal Laragon:

```bash
cd C:\laragon\www\inventaris-buku
mysql -u root < database/inventaris_buku.sql
```

**c. Konfigurasi `.env`**

Salin `.env.example` menjadi `.env` (ada titik di depan):

```bash
copy .env.example .env
```

Laragon memakai user `root` tanpa password, jadi isinya sudah sesuai dan tidak perlu diubah.
Jika di folder sudah ada file bernama `env` bawaan CodeIgniter, abaikan saja; pakai `.env` dari paket ini.

**d. Jalankan aplikasi**

Cara 1 (disarankan, **Auto Virtual Host** Laragon): klik kanan ikon Laragon → **Apache → Reload** (atau **Stop All → Start All**).
Laragon otomatis membuat alamat dari nama folder dan mengarahkannya ke folder `public/`. Buka:

**http://inventaris-buku.test**

Cara 2 (server bawaan CodeIgniter, tanpa virtual host):

```bash
php spark serve
```

lalu buka **http://localhost:8080** dan ubah `app.baseURL` di `.env` menjadi `'http://localhost:8080/'`.

> Jika `.test` tidak terbuka: pastikan **Menu → Preferences → General → Auto virtual hosts** dicentang,
> lalu Reload Apache. Jika memakai Nginx, pastikan `Document Root` mengarah ke `public/`.

## 3. Daftar Halaman

| URL | Fungsi |
|---|---|
| `/` | Beranda (nama aplikasi, total buku, buku terbaru) |
| `/buku` | Daftar buku + pencarian + pagination |
| `/buku/tambah` | Form tambah buku |
| `/buku/ubah/{id}` | Form ubah buku |
| `POST /buku/hapus/{id}` | Hapus buku (dengan konfirmasi) |

### Penjelasan Tampilan

#### Beranda

Beranda menjadi halaman awal aplikasi. Bagian ini menyediakan navigasi menuju daftar buku dan form penambahan, menampilkan jumlah seluruh buku yang tersimpan, serta menampilkan beberapa buku terbaru beserta penulis dan kategorinya.

![Tampilan beranda aplikasi Inventaris Buku](docs/screenshots/beranda.png)

#### Daftar Buku

Halaman daftar buku menampilkan koleksi dalam tabel berisi judul, penulis, tahun terbit, dan kategori. Kolom pencarian dapat digunakan untuk mencari berdasarkan judul, penulis, atau kategori. Tombol **Ubah** dan **Hapus** tersedia pada setiap baris, sedangkan tombol **Tambah Buku** membuka form untuk memasukkan data baru. Daftar juga mendukung pagination.

![Tampilan daftar buku, pencarian, dan aksi data](docs/screenshots/daftar-buku.png)

#### Form Tambah Buku

Form ini digunakan untuk memasukkan judul, penulis, tahun terbit, dan kategori buku. Kolom bertanda bintang wajib diisi; tombol **Simpan** mengirim data untuk divalidasi dan disimpan, sedangkan **Batal** membatalkan pengisian.

![Tampilan form tambah buku](docs/screenshots/tambah-buku.png)

## 4. Alur MVC (untuk demonstrasi)

- **Model** `app/Models/BukuModel.php`: terhubung ke tabel `buku`, berisi aturan validasi dan daftar kategori.
- **View** `app/Views/`: tampilan HTML + Bootstrap. `layout/main.php` adalah kerangka bersama, `buku/_form.php` dipakai ulang oleh form tambah dan ubah.
- **Controller** `app/Controllers/Buku.php`: menerima request, memanggil model, lalu mengirim data ke view.
- **Routes** `app/Config/Routes.php`: memetakan URL ke method controller.

Contoh alur tambah data: `/buku/tambah` (`create()` menampilkan form) → submit → `POST /buku/simpan` (`store()` memvalidasi lewat model) → jika gagal kembali ke form dengan pesan error; jika berhasil redirect ke `/buku` dengan pesan sukses.

## 5. Struktur Tabel `buku`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | INT UNSIGNED, AUTO_INCREMENT | Primary key |
| judul | VARCHAR(200) | Wajib |
| penulis | VARCHAR(150) | Wajib |
| tahun_terbit | SMALLINT UNSIGNED | Wajib, 1000–2100 |
| kategori | VARCHAR(80) | Wajib |
| created_at, updated_at | DATETIME | Diisi otomatis oleh CodeIgniter |

## 6. Pengujian Manual (checklist)

- [ ] Tambah buku dengan data valid → muncul pesan sukses
- [ ] Kirim form kosong → muncul pesan validasi
- [ ] Ubah data → perubahan tersimpan
- [ ] Hapus → muncul konfirmasi, data hilang setelah dikonfirmasi
- [ ] Cari "novel" → hasil terfilter
- [ ] Perkecil jendela browser → tampilan tetap rapi (responsif)

## 7. Masalah Umum

| Gejala | Solusi |
|---|---|
| `Unable to connect to the database` | Pastikan MySQL di Laragon menyala (Start All), database sudah diimpor, dan kredensial di `.env` benar (`root`, password kosong) |
| `intl extension is required` | Klik kanan ikon Laragon → PHP → Extensions → centang `intl` |
| `inventaris-buku.test` tidak bisa dibuka | Aktifkan *Auto virtual hosts* di Preferences, lalu Reload Apache; atau pakai `php spark serve` |
| Link/menu mengarah ke alamat salah atau 404 | `app.baseURL` di `.env` harus sama dengan alamat yang dipakai di browser (`http://inventaris-buku.test/` atau `http://localhost:8080/`) |
| Tampilan tanpa gaya | Perlu internet untuk memuat Bootstrap dari CDN |
| Perubahan `.env` tidak terbaca | Pastikan namanya `.env`, bukan `env` atau `.env.txt`, lalu Reload Apache |

## 8. Pengumpulan (GitHub)

Nama folder/repo: `NIM_Nama_InventarisBuku`. Jangan commit folder `vendor/` dan file `.env`
(sudah diabaikan oleh `.gitignore` bawaan CodeIgniter). Sertakan file `.sql`, README ini, dokumentasi
berisi tangkapan layar, dan tautan video demonstrasi.

## 9. Pernyataan Penggunaan Bantuan AI

Kode dasar aplikasi ini disusun dengan bantuan AI (Claude, Anthropic). Tinjau dan sesuaikan pernyataan ini
dengan proses pengerjaan yang sebenarnya sebelum dikumpulkan.

- Nama: Moh Habib Azka Alawi Saekhon D
- NIM: 240631100010
