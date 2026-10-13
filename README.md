# 🔐 Sistem Login/Register (PHP Native)

Sistem login dan registrasi sederhana menggunakan **PHP Native** dengan file **JSON** sebagai penyimpanan data. Dibuat sebagai **Tugas Rutin 7** mata kuliah Pemrograman Web.

## ✨ Fitur

- Form registrasi dengan validasi (nama, email, password)
- Validasi email menggunakan `filter_var()`
- Password di-hash dengan `password_hash()` dan diverifikasi dengan `password_verify()`
- Data user disimpan di file JSON
- Pengecekan duplikasi email saat registrasi
- Sistem login menggunakan **session**
- Dashboard yang diproteksi (redirect ke halaman login jika belum login)
- Logout dengan `session_destroy()`
- Sanitasi input dengan `htmlspecialchars()`
- Pesan error dan sukses yang jelas

## 🛠️ Teknologi

- PHP Native
- HTML5 & CSS3
- JSON (sebagai penyimpanan data)
- Apache (XAMPP)

## 📁 Struktur Project

```
TugasWeb-Pertemuan7-LoginRegister/
├── data/
│   └── users.example.json   # Contoh format data (users.json asli tidak di-upload)
├── register.php             # Halaman registrasi
├── login.php                # Halaman login
├── dashboard.php            # Halaman dashboard (diproteksi)
├── logout.php               # Proses logout
└── README.md
```

> Nama file di atas bisa berbeda dengan project kamu, sesuaikan jika perlu.

## 🚀 Cara Menjalankan

Project ini membutuhkan server PHP, jadi tidak bisa dibuka langsung lewat `index.html` atau Live Server.

1. Install [XAMPP](https://www.apachefriends.org/) dan jalankan **Apache** dari XAMPP Control Panel
2. Clone repository ini ke dalam folder `htdocs`:
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/Triana730/TugasWeb-Pertemuan7-LoginRegister.git
   ```
3. Buat file data user dari contoh:
   ```bash
   cd TugasWeb-Pertemuan7-LoginRegister
   copy data\users.example.json data\users.json
   ```
4. Buka di browser:
   ```
   http://localhost/TugasWeb-Pertemuan7-LoginRegister
   ```

## 🎮 Alur Penggunaan

1. Buka halaman **Register**, isi nama, email, dan password
2. Setelah berhasil, login dengan email dan password tadi
3. Kamu diarahkan ke **Dashboard**
4. Coba buka `dashboard.php` tanpa login. Kamu akan dikembalikan ke halaman login
5. Klik **Logout** untuk mengakhiri session

## 🔒 Catatan Keamanan

- Password tidak disimpan dalam bentuk asli, hanya hash dari `password_hash()`
- File `data/users.json` masuk `.gitignore` sehingga data user asli tidak ter-upload ke GitHub
- Semua input yang ditampilkan kembali dibersihkan dengan `htmlspecialchars()`

## 📸 Preview

_Tambahkan screenshot halaman register, login, dan dashboard di sini._

## 👤 Author

**Triana730**
GitHub: [@Triana730](https://github.com/Triana730)
