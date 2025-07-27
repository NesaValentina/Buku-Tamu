# Perpustakaan Digital

Sistem manajemen perpustakaan digital yang dibuat menggunakan **CodeIgniter 4** dan **MySQL**. Aplikasi ini menyediakan fitur CRUD lengkap untuk manajemen buku, sistem autentikasi admin, pencarian, dan pagination.

## 🚀 Fitur Utama

### ✨ Fitur Umum
- **Dashboard Beranda**: Menampilkan buku-buku terbaru dan statistik perpustakaan
- **Daftar Buku**: Katalog lengkap semua buku dengan pagination
- **Pencarian**: Cari buku berdasarkan judul, penulis, atau kategori
- **Detail Buku**: Informasi lengkap setiap buku termasuk sinopsis
- **Responsive Design**: Tampilan optimal di desktop dan mobile

### 🔐 Fitur Admin
- **Login/Logout**: Sistem autentikasi untuk admin
- **Dashboard Admin**: Statistik lengkap dengan grafik interaktif
- **CRUD Buku**: Tambah, edit, dan hapus buku
- **Manajemen Kategori**: Kelola kategori buku
- **Validasi Form**: Validasi lengkap untuk semua input

## 🛠 Teknologi yang Digunakan

- **Backend**: CodeIgniter 4.6.2
- **Database**: MySQL
- **Frontend**: Bootstrap 5.1.3
- **Icons**: Font Awesome 6.0
- **Charts**: Chart.js
- **Alerts**: SweetAlert2
- **PHP**: 7.4+

## 📋 Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache/Nginx Web Server
- Composer (untuk dependency management)
- Extension PHP: intl, mbstring, mysql, curl, xml

## 🔧 Instalasi

### 1. Clone atau Download Project
```bash
# Jika menggunakan Git
git clone [repository-url]
cd perpustakaan-digital

# Atau extract file ZIP
unzip perpustakaan-digital.zip
cd perpustakaan-digital
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Konfigurasi Database
```bash
# Copy file environment
cp env .env

# Edit file .env dan sesuaikan konfigurasi database:
database.default.hostname = localhost
database.default.database = perpustakaan_digital
database.default.username = root
database.default.password = your_password
database.default.DBDriver = MySQLi
```

### 4. Buat Database
```sql
CREATE DATABASE perpustakaan_digital;
```

### 5. Jalankan Migrasi
```bash
php spark migrate
```

### 6. Jalankan Aplikasi
```bash
# Development server
php spark serve

# Atau gunakan Apache/Nginx
# Arahkan document root ke folder 'public'
```

## 🔑 Login Admin Default

- **Username**: `admin`
- **Password**: `admin123`
- **Email**: `admin@perpustakaan.com`

## 📁 Struktur Database

### Tabel `books`
| Field | Type | Description |
|-------|------|-------------|
| id_buku | INT(11) AUTO_INCREMENT | Primary Key |
| judul_buku | VARCHAR(255) | Judul buku |
| penulis | VARCHAR(255) | Nama penulis |
| penerbit | VARCHAR(255) | Nama penerbit |
| tahun_terbit | YEAR | Tahun terbit |
| kategori | VARCHAR(100) | Kategori buku |
| sinopsis | TEXT | Ringkasan buku |
| created_at | DATETIME | Tanggal dibuat |
| updated_at | DATETIME | Tanggal diupdate |

### Tabel `admins`
| Field | Type | Description |
|-------|------|-------------|
| id | INT(11) AUTO_INCREMENT | Primary Key |
| username | VARCHAR(50) UNIQUE | Username admin |
| password | VARCHAR(255) | Password (encrypted) |
| email | VARCHAR(100) UNIQUE | Email admin |
| nama_lengkap | VARCHAR(255) | Nama lengkap |
| created_at | DATETIME | Tanggal dibuat |
| updated_at | DATETIME | Tanggal diupdate |

## 🎯 Endpoint/Routes

### Public Routes
- `GET /` - Halaman beranda
- `GET /books` - Daftar buku dengan search & pagination
- `GET /books/show/{id}` - Detail buku
- `GET /about` - Halaman tentang

### Auth Routes
- `GET /auth/login` - Halaman login
- `POST /auth/login` - Proses login
- `GET /auth/logout` - Logout

### Admin Routes (Protected)
- `GET /dashboard` - Dashboard admin
- `GET /books/create` - Form tambah buku
- `POST /books/store` - Simpan buku baru
- `GET /books/edit/{id}` - Form edit buku
- `POST /books/update/{id}` - Update buku
- `GET /books/delete/{id}` - Hapus buku

## 🎨 Fitur UI/UX

- **Modern Design**: Interface yang clean dan user-friendly
- **Responsive Layout**: Bootstrap 5 untuk semua ukuran layar
- **Interactive Elements**: Hover effects dan smooth transitions
- **Loading States**: Feedback visual untuk user actions
- **Form Validation**: Real-time validation dengan error messages
- **Confirmation Dialogs**: SweetAlert untuk konfirmasi aksi penting
- **Search Highlighting**: Highlight hasil pencarian
- **Pagination**: Navigate through large datasets easily

## 🔒 Keamanan

- **Password Hashing**: Menggunakan PHP `password_hash()`
- **CSRF Protection**: Built-in CSRF protection CodeIgniter
- **Input Validation**: Server-side validation untuk semua input
- **SQL Injection Prevention**: Menggunakan Query Builder CI4
- **XSS Protection**: Auto-escaping output dengan `esc()`
- **Session Management**: Secure session handling

## 📊 Fitur Analytics

- **Dashboard Statistics**: Total buku, kategori, dan trends
- **Category Distribution**: Grafik pie chart untuk distribusi kategori
- **Recent Activity**: Tracking buku terbaru yang ditambahkan
- **Search Analytics**: (Ready untuk implementasi)

## 🔄 Pengembangan Lebih Lanjut

Fitur yang bisa ditambahkan:
- [ ] Upload cover buku
- [ ] Sistem peminjaman buku
- [ ] Multi-user roles (admin, librarian, member)
- [ ] Export data ke Excel/PDF
- [ ] API endpoints
- [ ] Email notifications
- [ ] Advanced search filters
- [ ] Book recommendations
- [ ] Reading history
- [ ] Reviews and ratings

## 🐛 Troubleshooting

### Error Database Connection
1. Pastikan MySQL service berjalan
2. Cek konfigurasi database di file `.env`
3. Pastikan database sudah dibuat

### Error 404 Routes
1. Pastikan mod_rewrite Apache aktif
2. Cek file `.htaccess` di folder public
3. Untuk Nginx, konfigurasi URL rewriting

### Error Permission
```bash
# Set permission untuk folder writable
chmod -R 777 writable/
```

## 👥 Kontribusi

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -am 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📄 Lisensi

Project ini menggunakan lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail lengkap.

## 📞 Kontak

Jika ada pertanyaan atau masalah, silakan hubungi:
- **Email**: info@perpustakaan.com
- **Phone**: (021) 123-4567

---

**Perpustakaan Digital** - Sistem manajemen perpustakaan modern untuk era digital 📚✨
