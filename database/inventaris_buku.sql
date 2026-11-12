-- Database: inventaris_buku (data contoh/dummy)
CREATE DATABASE IF NOT EXISTS `inventaris_buku` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `inventaris_buku`;

DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(200) NOT NULL,
  `penulis` VARCHAR(150) NOT NULL,
  `tahun_terbit` SMALLINT UNSIGNED NOT NULL,
  `kategori` VARCHAR(80) NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `buku` (`judul`, `penulis`, `tahun_terbit`, `kategori`, `created_at`, `updated_at`) VALUES
('Laskar Pelangi', 'Andrea Hirata', 2005, 'Novel', NOW(), NOW()),
('Bumi Manusia', 'Pramoedya Ananta Toer', 1980, 'Novel', NOW(), NOW()),
('Negeri 5 Menara', 'Ahmad Fuadi', 2009, 'Novel', NOW(), NOW()),
('Filosofi Teras', 'Henry Manampiring', 2018, 'Pengembangan Diri', NOW(), NOW()),
('Atomic Habits', 'James Clear', 2018, 'Pengembangan Diri', NOW(), NOW()),
('Clean Code', 'Robert C. Martin', 2008, 'Teknologi', NOW(), NOW()),
('Dasar-Dasar Pemrograman Web', 'Contoh Penulis', 2021, 'Teknologi', NOW(), NOW()),
('Sapiens', 'Yuval Noah Harari', 2011, 'Sejarah', NOW(), NOW()),
('Sejarah Indonesia Modern', 'M.C. Ricklefs', 2008, 'Sejarah', NOW(), NOW()),
('Cosmos', 'Carl Sagan', 1980, 'Sains', NOW(), NOW()),
('Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 2016, 'Pengembangan Diri', NOW(), NOW()),
('Dilan 1990', 'Pidi Baiq', 2014, 'Novel', NOW(), NOW());
