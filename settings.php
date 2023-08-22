<?php
/**
 * NeferShell
 * Authors: Nefertary I. Forster
 * Version 1.0.1
 *
 * Harap buka settings.php dengan aplikasi
 * kode editor untuk mempermudah mengubah pengaturan.
 */

// Harap perhatikan titik koma (;) jangan terhapus.

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