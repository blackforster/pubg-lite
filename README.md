# NeferShell v1.0.1 Beta (Free)
## Overview
Ini adalah proyek iseng yang masih dalam tahap percobaan karena prosesnya yang lumayan cukup memakan waktu. Tapi ini sangat nyaman untuk Anda coba gunakan. Jika Anda memiliki masalah atau pertanyaan silahkan buka [Issues](https://github.com/blackforster/NeferShell/issues). Ini akan membantu pengembang repositori untuk memahami masalah yang Anda hadapi dan memberikan tanggapan yang tepat. Jangan ragu untuk menjelaskan masalah Anda secara rinci agar saya bisa memberikan solusi yang tepat dan akurat.
## Instalasi dan penggunaan
### 1. Install PHP dan ekstensi yang diperlukan.
Pertama, pastikan Anda sudah mengupdate semua paket/sumber yang ada ditermux
```
pkg update && pkg upgrade
```
Install php kemudian Anda juga perlu menginstal ekstensi xml dan curl. Anda dapat melakukannya dengan perintah-perintah berikut:
```
pkg install php
pkg install php-curl
pkg install php-xml
```
### 2. Unduh repositori dengan git
Jika git belum terpasang Anda dapat menginstalnya dengan:
```
pkg install git
```
Kemudian unduh repositori ini
```
git clone https://github.com/blackforster/NeferShell
```
### 3. Cara penggunaan
Setelah semuanya siap, sekarang Anda dapat menjalankan repositori dengan perintah berikut:
```
cd NeferShell
php run.php
```
## Pengaturan skrip
Anda dapat mengatur berjalannya skrip ini pada file `setting.php`
```php
// Aktifkan debugging untuk memantau aktifitas skrip secara keseluruhan.
// Isikan true untuk menghidupkan, false untuk mematikan dan null untuk selalu menanyakan debugging.
$crackDebug = null; // true | false | null

// Default metode crack.
// Isikan 'free' atau 'mobile'. Kosongkan '' untuk selalu menanyakan.
$crackMethod = ''; // '' | 'mobile' | 'free'

// Default akhiran kata sandi.
// Isikan dengan format array. Kosongkan [] untuk tidak menggunakan akhiran kata sandi.
$pwdSuffix = ['123', '321', '1234', '12345', '123456']; // [] | ['1', '12', '123']

// Default kata sandi tambahan.
// Isikan dengan format array. Kosongkan [] untuk tidak menggunakan kata sandi tambahan.
$pwdAddition = []; // [] | ['qwerty', 'kata sandi', 'sayang']

// Default akhiran untuk tambahan kata sandi.
// Isikan dengan format array. Kosongkan [] untuk tidak menggunakan akhiran pada kata sandi tambahan.
$pwdAdditionSuffix = []; // [] | ['1', '12', '123']

// Default jadikan kata sandi tambahan yang pertama kali harus di proses.
// Isikan true untuk mendahulukan proses kata sandi tambahan atau false untuk tidak.
$pwdAdditionFirstProcess = true;

// Aktifkan otomatis mode pesawat.
// Masukkan tautan webhook untuk otomatisasi mode pesawat. Kosongkan '' untuk menonaktifkan.
// Gunakan aplikasi MacroDroid, Tasker atau aplikasi sejenis untuk mengaktifkan mode pesawat secara otomatis.
$flightModeWebhookUrl = ''; // '' | 'https://example.com'

// Hidupkan mode pesawat setiap beberapa ID.
// Masukkan angka atau masukkan angka 0 untuk otomatis (biasanya akan diotomatisasi ketika alamat IP terblokir).
// Jika variable $flightModeWebhookUrl tidak diisi maka skrip akan meminta pengguna untuk menyalakan mode pesawat secara manual.
$flightModeEvery = 0;
```
## Hak Cipta

Hak Cipta © Nefertary I. Forster.

## Lisensi

Proyek ini dilisensikan di bawah [Unlicense](LICENSE) - lihat file [LICENSE](LICENSE) untuk detailnya.
