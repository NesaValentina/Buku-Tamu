-- ========================================
-- Database Structure untuk Perpustakaan Digital
-- CodeIgniter 4 - MySQL Database
-- ========================================

-- Buat database
CREATE DATABASE IF NOT EXISTS `perpustakaan_digital` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `perpustakaan_digital`;

-- ========================================
-- Tabel untuk menyimpan data admin
-- ========================================
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Tabel untuk menyimpan data buku
-- ========================================
CREATE TABLE `books` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `judul_buku` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `sinopsis` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_buku`),
  KEY `idx_kategori` (`kategori`),
  KEY `idx_penulis` (`penulis`),
  KEY `idx_tahun` (`tahun_terbit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Tabel untuk tracking migrasi CodeIgniter
-- ========================================
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Insert data admin default
-- ========================================
INSERT INTO `admins` (`username`, `password`, `email`, `nama_lengkap`, `created_at`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@perpustakaan.com', 'Administrator', NOW());

-- Password default: admin123

-- ========================================
-- Insert data buku sample
-- ========================================
INSERT INTO `books` (`judul_buku`, `penulis`, `penerbit`, `tahun_terbit`, `kategori`, `sinopsis`, `created_at`) VALUES
('Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'Fiksi', 'Novel yang menceritakan tentang kehidupan sekolah di Belitung dan perjuangan para murid untuk mendapatkan pendidikan yang layak. Kisah yang menginspirasi tentang persahabatan dan cita-cita.', NOW()),

('Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 'Sejarah', 'Novel pertama dari Tetralogi Buru yang mengisahkan kehidupan Minke, seorang pribumi yang mendapat pendidikan Eropa di masa kolonial Belanda. Karya klasik sastra Indonesia.', NOW()),

('The Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, 'Teknologi', 'Handbook untuk pengembang software tentang bagaimana menulis kode yang bersih, mudah dibaca, dan mudah dipelihara. Panduan wajib untuk programmer profesional.', NOW()),

('Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Harvill Secker', 2014, 'Sejarah', 'Buku yang mengeksplorasi bagaimana Homo sapiens berhasil menguasai dunia. Membahas revolusi kognitif, pertanian, dan sains yang mengubah peradaban manusia.', NOW()),

('Atomic Habits', 'James Clear', 'Avery', 2018, 'Pendidikan', 'Panduan praktis tentang bagaimana membangun kebiasaan baik dan menghilangkan kebiasaan buruk. Metode yang telah terbukti untuk perubahan diri yang berkelanjutan.', NOW()),

('Filosofi Teras', 'Henry Manampiring', 'Kompas Gramedia', 2018, 'Filsafat', 'Pengantar filosofi Stoik yang dikemas dalam bahasa yang mudah dipahami. Membahas bagaimana filosofi Yunani kuno dapat diterapkan dalam kehidupan modern.', NOW()),

('The Psychology of Money', 'Morgan Housel', 'Harriman House', 2020, 'Ekonomi', 'Buku yang membahas aspek psikologi dalam mengelola keuangan. Mengungkap mengapa orang pintar membuat keputusan keuangan yang buruk dan bagaimana mengatasinya.', NOW()),

('Design Patterns', 'Gang of Four', 'Addison-Wesley', 1994, 'Teknologi', 'Buku klasik dalam pengembangan software yang membahas 23 design pattern yang dapat digunakan untuk memecahkan masalah umum dalam pemrograman berorientasi objek.', NOW());

-- ========================================
-- Insert data migrasi
-- ========================================
INSERT INTO `migrations` (`version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
('2025-07-27-134334', 'App\\Database\\Migrations\\CreateBooksTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2025-07-27-134338', 'App\\Database\\Migrations\\CreateAdminsTable', 'default', 'App', UNIX_TIMESTAMP(), 1);

-- ========================================
-- Indexes untuk optimasi performance
-- ========================================
ALTER TABLE `books` ADD INDEX `idx_search` (`judul_buku`, `penulis`, `kategori`);
ALTER TABLE `books` ADD FULLTEXT `ft_search` (`judul_buku`, `penulis`, `sinopsis`);

-- ========================================
-- Views untuk kemudahan query
-- ========================================
CREATE VIEW `v_book_stats` AS
SELECT 
    kategori,
    COUNT(*) as jumlah_buku,
    AVG(tahun_terbit) as rata_rata_tahun,
    MIN(tahun_terbit) as tahun_tertua,
    MAX(tahun_terbit) as tahun_terbaru
FROM books 
GROUP BY kategori 
ORDER BY jumlah_buku DESC;

CREATE VIEW `v_recent_books` AS
SELECT 
    id_buku,
    judul_buku,
    penulis,
    penerbit,
    tahun_terbit,
    kategori,
    created_at
FROM books 
ORDER BY created_at DESC 
LIMIT 10;

-- ========================================
-- Stored Procedures (Optional)
-- ========================================
DELIMITER //
CREATE PROCEDURE GetBooksByCategory(IN cat_name VARCHAR(100))
BEGIN
    SELECT * FROM books WHERE kategori = cat_name ORDER BY judul_buku;
END //

CREATE PROCEDURE SearchBooks(IN search_term VARCHAR(255))
BEGIN
    SELECT * FROM books 
    WHERE judul_buku LIKE CONCAT('%', search_term, '%')
       OR penulis LIKE CONCAT('%', search_term, '%')
       OR kategori LIKE CONCAT('%', search_term, '%')
    ORDER BY 
        CASE 
            WHEN judul_buku LIKE CONCAT('%', search_term, '%') THEN 1
            WHEN penulis LIKE CONCAT('%', search_term, '%') THEN 2
            ELSE 3
        END,
        judul_buku;
END //
DELIMITER ;

-- ========================================
-- Triggers untuk audit log (Optional)
-- ========================================
CREATE TABLE `book_audit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `action` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_book_id` (`book_id`),
  KEY `idx_action` (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELIMITER //
CREATE TRIGGER book_audit_insert 
AFTER INSERT ON books
FOR EACH ROW
BEGIN
    INSERT INTO book_audit_log (book_id, action, new_values)
    VALUES (NEW.id_buku, 'INSERT', JSON_OBJECT(
        'judul_buku', NEW.judul_buku,
        'penulis', NEW.penulis,
        'penerbit', NEW.penerbit,
        'tahun_terbit', NEW.tahun_terbit,
        'kategori', NEW.kategori,
        'sinopsis', NEW.sinopsis
    ));
END //

CREATE TRIGGER book_audit_update 
AFTER UPDATE ON books
FOR EACH ROW
BEGIN
    INSERT INTO book_audit_log (book_id, action, old_values, new_values)
    VALUES (NEW.id_buku, 'UPDATE', 
        JSON_OBJECT(
            'judul_buku', OLD.judul_buku,
            'penulis', OLD.penulis,
            'penerbit', OLD.penerbit,
            'tahun_terbit', OLD.tahun_terbit,
            'kategori', OLD.kategori,
            'sinopsis', OLD.sinopsis
        ),
        JSON_OBJECT(
            'judul_buku', NEW.judul_buku,
            'penulis', NEW.penulis,
            'penerbit', NEW.penerbit,
            'tahun_terbit', NEW.tahun_terbit,
            'kategori', NEW.kategori,
            'sinopsis', NEW.sinopsis
        )
    );
END //

CREATE TRIGGER book_audit_delete 
BEFORE DELETE ON books
FOR EACH ROW
BEGIN
    INSERT INTO book_audit_log (book_id, action, old_values)
    VALUES (OLD.id_buku, 'DELETE', JSON_OBJECT(
        'judul_buku', OLD.judul_buku,
        'penulis', OLD.penulis,
        'penerbit', OLD.penerbit,
        'tahun_terbit', OLD.tahun_terbit,
        'kategori', OLD.kategori,
        'sinopsis', OLD.sinopsis
    ));
END //
DELIMITER ;

-- ========================================
-- Konfigurasi untuk optimasi
-- ========================================
-- Set charset untuk emoji support
ALTER DATABASE `perpustakaan_digital` CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ========================================
-- Backup command (untuk referensi)
-- ========================================
-- mysqldump -u root -p perpustakaan_digital > backup_perpustakaan_digital.sql

-- ========================================
-- Database berhasil dibuat!
-- Login admin default:
-- Username: admin
-- Password: admin123
-- ========================================