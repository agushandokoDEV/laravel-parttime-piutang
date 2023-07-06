-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Jun 2023 pada 08.34
-- Versi server: 8.0.33-0ubuntu0.20.04.2
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinensia-piutang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita_acaras`
--

CREATE TABLE `berita_acaras` (
  `id` bigint UNSIGNED NOT NULL,
  `usulans_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `docs_berita` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `berita_acaras`
--

INSERT INTO `berita_acaras` (`id`, `usulans_id`, `judul`, `docs_berita`, `created_at`, `updated_at`) VALUES
(1, 1, 'Acara Syukuran', 'Acara Syukuran.pdf', '2023-06-26 01:23:22', '2023-06-26 01:23:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_piutangs`
--

CREATE TABLE `jenis_piutangs` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_piutangs`
--

INSERT INTO `jenis_piutangs` (`id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'Lain-lain Pendapatan Asli Daerah', '2023-06-26 01:18:43', '2023-06-26 01:18:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keputusan_gubernurs`
--

CREATE TABLE `keputusan_gubernurs` (
  `id` bigint UNSIGNED NOT NULL,
  `usulans_id` bigint UNSIGNED NOT NULL,
  `nomor_keputusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_keputusan` date NOT NULL,
  `docs_keputusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keputusan_gubernurs`
--

INSERT INTO `keputusan_gubernurs` (`id`, `usulans_id`, `nomor_keputusan`, `tgl_keputusan`, `docs_keputusan`, `created_at`, `updated_at`) VALUES
(1, 1, 'GBR-26.06.23/0001', '2023-06-27', '1eOE1.pdf', '2023-06-26 01:23:12', '2023-06-26 01:23:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_06_17_174455_create_jenis_piutangs_table', 1),
(5, '2023_06_18_024705_create_surat_usulans_table', 1),
(6, '2023_06_18_183950_create_surat_usulan_k_n_k_p_l_s_table', 1),
(7, '2023_06_18_202602_create_surat_balasan_k_n_k_p_l_s_table', 1),
(8, '2023_06_18_204158_create_keputusan_gubernurs_table', 1),
(9, '2023_06_18_205212_create_berita_acaras_table', 1),
(10, '2023_06_23_200807_create_pembayarans_table', 1),
(11, '2023_06_24_080111_create_pemberitahuans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `usulans_id` bigint UNSIGNED NOT NULL,
  `tgl_bayar` timestamp NOT NULL,
  `nominal_bayar` decimal(10,2) NOT NULL,
  `docs_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemberitahuans`
--

CREATE TABLE `pemberitahuans` (
  `id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `usulans_id` bigint UNSIGNED NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemberitahuans`
--

INSERT INTO `pemberitahuans` (`id`, `users_id`, `usulans_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '<p>Tolong Lengkapi Dokumen Berikut</p><ul><li>SKPD</li><li>SKRD</li><li>Dll</li></ul>', '2023-06-26 01:23:00', '2023-06-26 01:23:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_balasan_knkpls`
--

CREATE TABLE `surat_balasan_knkpls` (
  `id` bigint UNSIGNED NOT NULL,
  `usulans_id` bigint UNSIGNED NOT NULL,
  `nomor_balasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_balasan` date NOT NULL,
  `docs_balasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_balasan_knkpls`
--

INSERT INTO `surat_balasan_knkpls` (`id`, `usulans_id`, `nomor_balasan`, `tgl_balasan`, `docs_balasan`, `created_at`, `updated_at`) VALUES
(1, 1, 'BLS-26.06.23/0001', '2023-06-27', 'kUTh3.pdf', '2023-06-26 01:23:00', '2023-06-26 01:23:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_usulans`
--

CREATE TABLE `surat_usulans` (
  `id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `id_jenis` bigint UNSIGNED DEFAULT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rincian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda` decimal(10,2) DEFAULT NULL,
  `tgl_surat` date NOT NULL,
  `nilai_rincian` decimal(10,2) NOT NULL,
  `total_rincian` decimal(10,2) NOT NULL,
  `select_STS` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `select_ST` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `select_DL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs_STS` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs_ST` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs_DL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs_skdp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs_ID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs_lainnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_usulans`
--

INSERT INTO `surat_usulans` (`id`, `users_id`, `id_jenis`, `nama_peminjam`, `nomor_surat`, `rincian`, `denda`, `tgl_surat`, `nilai_rincian`, `total_rincian`, `select_STS`, `select_ST`, `select_DL`, `docs_STS`, `docs_ST`, `docs_DL`, `docs_skdp`, `docs_ID`, `docs_lainnya`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'PT.BENTENG TEGUH PERKASA', 'USL-26.06.23/0001', 'Hutang Daerah', '50000.00', '2009-04-24', '45000000.00', '45000000.00', 'Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan', 'Surat Tagiahan ke-2', 'Foto Dokumentasi', 'OkOUt.pdf', 'OMKSq.pdf', 'bfSKb.pdf', 'n9gs5.pdf', 'brVcy.pdf', 'Rt2yX.pdf', '2023-06-26 01:18:43', '2023-06-26 01:33:20'),
(2, 2, 1, 'PT.BENTENG TEGUH PERKASA', 'USL-26.06.23/0002', 'Hutang Daerah', '50000.00', '2009-04-24', '301000.00', '301000.00', 'Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan', 'Surat Tagiahan ke-2', 'Foto Dokumentasi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 01:18:43', '2023-06-26 01:18:43'),
(3, 2, 1, 'RS.Islam', 'USL-26.06.23/0002', 'Hutang Rumah Sakit', '50000.00', '2008-12-25', '37189900.00', '37189900.00', 'Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan', 'Surat Tagiahan ke-2', 'Foto Dokumentasi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 01:18:43', '2023-06-26 01:18:43'),
(4, 2, 1, 'PT. PHILINDO SPORTING AMUS', 'USL-26.06.23/0002', 'Hutang PT', '50000.00', '2008-12-25', '49985000.00', '49985000.00', 'Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan', 'Surat Tagiahan ke-2', 'Foto Dokumentasi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 01:18:43', '2023-06-26 01:18:43'),
(5, 2, 1, 'PT Sahid Inti Dinamika', 'USL-26.06.23/0002', 'Hutang PT', '50000.00', '2010-12-25', '1649000.00', '1649000.00', 'Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan', 'Surat Tagiahan ke-2', 'Foto Dokumentasi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 01:18:43', '2023-06-26 01:18:43'),
(6, 2, 1, 'PT Sahid Inti Dinamika', 'USL-26.06.23/0002', 'Hutang PT', '50000.00', '2010-12-25', '9323900.00', '9323900.00', 'Piutang Retribusi Daerah Lebih dari 12(dua belas) bulan', 'Surat Tagiahan ke-2', 'Foto Dokumentasi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-26 01:18:43', '2023-06-26 01:18:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_usulan_knkpls`
--

CREATE TABLE `surat_usulan_knkpls` (
  `id` bigint UNSIGNED NOT NULL,
  `usulans_id` bigint UNSIGNED NOT NULL,
  `nomor_knkpl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_knkpl` date NOT NULL,
  `docs_knkpl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_usulan_knkpls`
--

INSERT INTO `surat_usulan_knkpls` (`id`, `usulans_id`, `nomor_knkpl`, `tgl_knkpl`, `docs_knkpl`, `created_at`, `updated_at`) VALUES
(1, 1, 'KNKPL-26.06.23/0001', '2023-06-20', 'B55D4.pdf', '2023-06-26 01:22:00', '2023-06-26 01:22:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_skpd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','nasabah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `no_skpd`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, 'admin', 'admin@gmail.com', NULL, '$2y$10$WUAGj34tMinDXuGQhTdMkuGJ.YHZKLXMEyF83cEUuyTaKkZwDehNC', NULL, '2023-06-26 01:18:43', '2023-06-26 01:18:43'),
(2, 'DINAS LINGKUNGAN HIDUP', '405947/078.800', 'nasabah', 'user1@gmail.com', NULL, '$2y$10$LH7H8OOzA9U1gLbnh56USuaDkWGjDKvU.rV9Cb1vzhl6Af9YZU6li', NULL, '2023-06-26 01:18:43', '2023-06-26 01:18:43'),
(3, 'DPRD KOTA BANDUNG', '405947/078.802', 'nasabah', 'user2@gmail.com', NULL, '$2y$10$D3fUR9PfDOg19GVUjY5pF.1I0EPfDlJ6LLCc4jZzsNIZVgmLX10g.', NULL, '2023-06-26 01:18:43', '2023-06-26 01:18:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita_acaras`
--
ALTER TABLE `berita_acaras`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jenis_piutangs`
--
ALTER TABLE `jenis_piutangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keputusan_gubernurs`
--
ALTER TABLE `keputusan_gubernurs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemberitahuans`
--
ALTER TABLE `pemberitahuans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_balasan_knkpls`
--
ALTER TABLE `surat_balasan_knkpls`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_usulans`
--
ALTER TABLE `surat_usulans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_usulan_knkpls`
--
ALTER TABLE `surat_usulan_knkpls`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita_acaras`
--
ALTER TABLE `berita_acaras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_piutangs`
--
ALTER TABLE `jenis_piutangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `keputusan_gubernurs`
--
ALTER TABLE `keputusan_gubernurs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemberitahuans`
--
ALTER TABLE `pemberitahuans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_balasan_knkpls`
--
ALTER TABLE `surat_balasan_knkpls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_usulans`
--
ALTER TABLE `surat_usulans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `surat_usulan_knkpls`
--
ALTER TABLE `surat_usulan_knkpls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
