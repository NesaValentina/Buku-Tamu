# 📚 Panduan Instalasi Perpustakaan Digital

## 📋 Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut:

- **PHP**: 7.4 atau lebih tinggi
- **MySQL**: 5.7 atau lebih tinggi  
- **Web Server**: Apache atau Nginx
- **Composer**: untuk dependency management
- **Extension PHP yang diperlukan**:
  - intl
  - mbstring
  - mysql (mysqli/pdo_mysql)
  - curl
  - xml
  - zip
  - gd (opsional, untuk manipulasi gambar)

## 🚀 Langkah Instalasi

### 1. Download dan Extract

```bash
# Download file perpustakaan-digital.zip
# Extract file ZIP ke direktori web server
unzip perpustakaan-digital.zip
cd perpustakaan-digital
```

### 2. Install Dependencies

```bash
# Install package menggunakan Composer
composer install

# Jika belum punya Composer, install terlebih dahulu:
# curl -sS https://getcomposer.org/installer | php
# mv composer.phar /usr/local/bin/composer
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp env .env

# Edit file .env sesuai konfigurasi Anda
nano .env
```

**Konfigurasi utama dalam file .env:**

```env
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------
CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'http://localhost:8080'
# Sesuaikan dengan URL Anda, contoh: 'http://perpustakaan.local'

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = perpustakaan_digital
database.default.username = root
database.default.password = your_password_here
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

### 4. Setup Database

#### Opsi A: Menggunakan File SQL (Direkomendasikan)

```bash
# Login ke MySQL
mysql -u root -p

# Import database structure
mysql -u root -p < database_structure.sql
```

#### Opsi B: Menggunakan Migrasi CodeIgniter

```bash
# Buat database terlebih dahulu
mysql -u root -p -e "CREATE DATABASE perpustakaan_digital;"

# Jalankan migrasi
php spark migrate
```

### 5. Set Permissions

```bash
# Set permission untuk folder writable
chmod -R 755 writable/
chmod -R 755 public/

# Jika di server production, gunakan:
# chown -R www-data:www-data perpustakaan-digital/
# chmod -R 755 perpustakaan-digital/
# chmod -R 777 writable/
```

### 6. Konfigurasi Web Server

#### Apache (.htaccess sudah tersedia)

Pastikan **mod_rewrite** aktif:

```bash
# Ubuntu/Debian
sudo a2enmod rewrite
sudo systemctl restart apache2

# CentOS/RHEL
# mod_rewrite biasanya sudah aktif secara default
```

**Virtual Host (Opsional tapi direkomendasikan):**

```apache
<VirtualHost *:80>
    ServerName perpustakaan.local
    DocumentRoot /path/to/perpustakaan-digital/public
    
    <Directory /path/to/perpustakaan-digital/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/perpustakaan_error.log
    CustomLog ${APACHE_LOG_DIR}/perpustakaan_access.log combined
</VirtualHost>
```

#### Nginx

```nginx
server {
    listen 80;
    server_name perpustakaan.local;
    root /path/to/perpustakaan-digital/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock; # Sesuaikan versi PHP
    }

    location ~ /\.ht {
        deny all;
    }
}
```

### 7. Jalankan Aplikasi

#### Development Server (untuk testing)

```bash
cd perpustakaan-digital
php spark serve
```

Akses: `http://localhost:8080`

#### Production Server

Akses melalui web server yang sudah dikonfigurasi.

## 🔑 Login Default

Setelah instalasi berhasil, gunakan akun admin berikut:

- **URL Login**: `http://your-domain/auth/login`
- **Username**: `admin`
- **Password**: `admin123`
- **Email**: `admin@perpustakaan.com`

> ⚠️ **PENTING**: Segera ubah password default setelah login pertama!

## 🧪 Testing Instalasi

### 1. Cek Halaman Utama
- Buka `http://your-domain`
- Pastikan tampil halaman beranda dengan benar
- Cek apakah data sample buku tampil

### 2. Test Fitur Pencarian
- Gunakan form pencarian di halaman utama
- Coba cari "Laskar Pelangi" atau "Teknologi"

### 3. Test Login Admin
- Buka `http://your-domain/auth/login`
- Login dengan akun default
- Pastikan dashboard admin dapat diakses

### 4. Test CRUD Buku
- Tambah buku baru
- Edit buku yang sudah ada
- Hapus buku (hati-hati!)

## 🔧 Troubleshooting

### Error "Database connection failed"

```bash
# Cek apakah MySQL berjalan
sudo systemctl status mysql

# Cek konfigurasi database di .env
# Pastikan username, password, dan database name benar
```

### Error "404 Page Not Found"

```bash
# Pastikan mod_rewrite aktif (Apache)
sudo a2enmod rewrite

# Cek file .htaccess di folder public/
# Pastikan AllowOverride All di konfigurasi Apache
```

### Error "Permission denied"

```bash
# Set permission yang benar
sudo chown -R www-data:www-data /path/to/perpustakaan-digital
sudo chmod -R 755 /path/to/perpustakaan-digital
sudo chmod -R 777 /path/to/perpustakaan-digital/writable
```

### Error "Class not found" atau "Composer error"

```bash
# Install ulang dependencies
rm -rf vendor/
composer install

# Atau update composer
composer update
```

### Error "Session" atau "CSRF"

```bash
# Pastikan folder writable dapat ditulis
chmod -R 777 writable/

# Clear cache
rm -rf writable/cache/*
rm -rf writable/session/*
```

## 🛡️ Keamanan Production

### 1. Ganti Environment ke Production

```env
# Di file .env
CI_ENVIRONMENT = production
```

### 2. Disable Debug Mode

```php
// app/Config/App.php
public bool $appTimezone = 'Asia/Jakarta'; // Sesuaikan timezone
```

### 3. Update Password Default

- Login sebagai admin
- Ganti password default
- Pertimbangkan membuat admin baru dan hapus yang default

### 4. Database Security

```sql
-- Buat user database khusus (jangan gunakan root)
CREATE USER 'perpus_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT SELECT, INSERT, UPDATE, DELETE ON perpustakaan_digital.* TO 'perpus_user'@'localhost';
FLUSH PRIVILEGES;
```

### 5. File Permissions

```bash
# Set permission yang tepat untuk production
find /path/to/perpustakaan-digital -type f -exec chmod 644 {} \;
find /path/to/perpustakaan-digital -type d -exec chmod 755 {} \;
chmod -R 777 writable/
```

## 📊 Backup Database

```bash
# Backup database (jalankan secara berkala)
mysqldump -u root -p perpustakaan_digital > backup_$(date +%Y%m%d_%H%M%S).sql

# Restore database
mysql -u root -p perpustakaan_digital < backup_file.sql
```

## 🔄 Update Aplikasi

```bash
# Backup data terlebih dahulu
mysqldump -u root -p perpustakaan_digital > backup_before_update.sql

# Backup folder writable (session, logs, uploads)
cp -r writable/ writable_backup/

# Update aplikasi
# ... (replace files with new version)

# Update dependencies
composer install

# Jalankan migrasi jika ada
php spark migrate

# Restore custom configurations
```

## 📞 Support

Jika mengalami masalah:

1. **Cek log error**: `writable/logs/`
2. **Enable debug mode**: Set `CI_ENVIRONMENT = development` di `.env`
3. **Cek dokumentasi CodeIgniter 4**: https://codeigniter.com/user_guide/
4. **Hubungi developer** melalui email atau GitHub issues

---

**Selamat! Aplikasi Perpustakaan Digital siap digunakan! 📚✨**