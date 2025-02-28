-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2025 pada 03.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '0001_01_01_000000_create_users_table', 1),
(13, '0001_01_01_000001_create_cache_table', 1),
(14, '0001_01_01_000002_create_jobs_table', 1),
(15, '2025_01_28_101645_create_tasks_table', 1),
(16, '2025_01_28_163938_add_parent_id_to_tasks_table', 2),
(26, '2025_01_29_181430_add_device_token_to_users_table', 5),
(28, '2025_01_28_164625_add_deadline_to_tasks_table', 6),
(29, '2025_01_28_180857_create_sub_tasks_table', 6),
(30, '2025_01_28_181416_add_completed_to_sub_tasks_table', 6),
(31, '2025_02_09_150640_add_is_favorite_to_tasks_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('aditya9@gmail.com', '$2y$12$npmITLfn3539J4uIDhSbzOg72VB4N7xar7Js6oBQuUykXzKH5YBRm', '2025-02-17 19:08:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Pt6JjyDgRhdALMQ0VhE4OvJHFYz7rMF8BoGEpxs5', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTEJudG5QaURFU2ZCbU5JMENvTHllNVA0NEgyajN2ZENibVFDWEhPMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1740174043);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_tasks`
--

CREATE TABLE `sub_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sub_tasks`
--

INSERT INTO `sub_tasks` (`id`, `task_id`, `description`, `completed`, `created_at`, `updated_at`) VALUES
(1, 1, 'baybay laravel', 1, '2025-02-19 20:39:04', '2025-02-19 20:39:09'),
(10, 16, 'sdad', 1, '2025-02-21 09:30:16', '2025-02-21 09:32:36'),
(11, 20, 'subtugas 1', 1, '2025-02-21 09:56:55', '2025-02-21 09:57:01'),
(12, 20, 'subtugas 2', 0, '2025-02-21 09:56:55', '2025-02-21 09:56:55'),
(17, 26, 'subtugas1', 1, '2025-02-21 10:33:31', '2025-02-21 10:33:43'),
(18, 26, 'subtugas2', 1, '2025-02-21 10:33:31', '2025-02-21 10:33:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `deadline` date DEFAULT NULL,
  `is_favorite` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `description`, `created_at`, `updated_at`, `completed`, `deadline`, `is_favorite`) VALUES
(1, 10, 'jama kematian', '2025-02-19 20:32:48', '2025-02-19 20:44:59', 1, '2025-02-27', 0),
(2, 10, 'anjayy', '2025-02-19 20:38:40', '2025-02-19 20:43:08', 0, '2025-02-27', 1),
(3, 10, 'gggg', '2025-02-19 20:48:21', '2025-02-19 20:48:21', 0, '2025-02-20', 0),
(4, 10, 'so do i look', '2025-02-19 20:48:46', '2025-02-19 20:48:46', 0, '2025-02-28', 0),
(14, 2, 'asd', '2025-02-21 09:10:00', '2025-02-21 09:15:02', 1, '2025-02-21', 0),
(16, 2, 'asd', '2025-02-21 09:30:03', '2025-02-21 09:32:36', 0, '2025-02-25', 0),
(17, 3, 'tugas prioritas', '2025-02-21 09:54:26', '2025-02-21 09:54:28', 0, '2025-02-28', 1),
(18, 3, 'tugas biasa', '2025-02-21 09:54:39', '2025-02-21 09:54:39', 0, '2025-02-28', 0),
(19, 3, 'tugas mendekati deadline', '2025-02-21 09:54:57', '2025-02-21 09:54:57', 0, '2025-02-22', 0),
(20, 3, 'tugas dengan subtugas', '2025-02-21 09:55:21', '2025-02-21 09:55:21', 0, '2025-02-28', 0),
(21, 3, 'tugas prioritas selesai', '2025-02-21 09:57:21', '2025-02-21 09:57:29', 1, '2025-02-28', 1),
(22, 3, 'tugas biasa selesai', '2025-02-21 10:26:52', '2025-02-21 10:26:56', 1, '2025-02-28', 0),
(23, 3, 'tugas mendekati deadline selesai', '2025-02-21 10:27:16', '2025-02-21 10:27:21', 1, '2025-02-22', 0),
(26, 3, 'tugas dengan subtugas selesai', '2025-02-21 10:33:11', '2025-02-21 11:01:18', 1, '2025-02-28', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `device_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@gmail.com', 'user', NULL, '$2y$12$4qWmxfQWj1sRjAq7Aj3GwuvVeBJPBo6oNQyYjxH.nnkxLVdRIznrC', NULL, NULL, '2025-01-28 07:42:14', '2025-01-28 07:42:14'),
(2, 'aditya handiana', 'aditya9@gmail.com', 'user', NULL, '$2y$12$me00i9xBsI./rSR8EKsKbe4gqU1kUU6RtNyoyj7CyiVivn1DGrO2y', NULL, NULL, '2025-01-28 12:02:45', '2025-01-28 12:02:45'),
(3, 'handiana', 'handiana@gmail.com', 'user', NULL, '$2y$12$KXQI3j9DI7bOXUyB.WfbmuSABbask/qtbGuecodWwKgS.s223YC.6', NULL, '0WdrDA5015UM4trWbmiv0POZ1ao1qcvxzyae8xOOlu6gWSgHzr8a3DSTaMCm', '2025-01-29 06:46:04', '2025-01-29 06:46:04'),
(5, 'iniel', 'inielanjing@gmail.com', 'user', NULL, '$2y$12$sVjgmxHTdnon7ayh6HCW.uXDvjxUvHQpY7.Lju0iTTR5BODZp4wYG', NULL, NULL, '2025-02-02 22:45:57', '2025-02-02 22:45:57'),
(6, 'olama', 'olama@gmail.com', 'user', NULL, '$2y$12$FYRVRH6JMTJHJs/yRWI2r.BS.HBpcATJILErIB.g/u2MUe.nmG5gi', NULL, NULL, '2025-02-09 10:20:06', '2025-02-09 10:20:06'),
(7, 'meilany', 'mei@gmail.com', 'user', NULL, '$2y$12$lcFwPxil.Vz5XvOebjnmG.imeEh45naBvIPAjV.vp39RjXRsvup46', NULL, NULL, '2025-02-17 01:18:25', '2025-02-17 01:18:25'),
(8, 'nayaka', 'nayaka@gmail.com', 'user', NULL, '$2y$12$ANXVjraKKMO1JNqowJf0pOfTtG4KRf/8ujc6o691LnwZUUjrBbmPe', NULL, NULL, '2025-02-17 19:35:12', '2025-02-17 19:35:12'),
(9, 'tahu', 'tahu@gmail.com', 'user', NULL, '$2y$12$GLm1mMoDJzT.LSWpaLjZneojW.tOFPa6DIjpOG5uzSPYDonWt9lhy', NULL, NULL, '2025-02-17 19:39:32', '2025-02-17 19:39:32'),
(10, 'aditya handiana putra2', 'handiana4@gmail.com', 'user', NULL, '$2y$12$pMuPXGcgzap7/s3ex2.HzeGrsVaDfpDFz4yCpXcTT7cGi8Hq8kSPS', NULL, NULL, '2025-02-19 19:59:43', '2025-02-19 19:59:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `sub_tasks`
--
ALTER TABLE `sub_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_tasks_task_id_foreign` (`task_id`) USING BTREE;

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `sub_tasks`
--
ALTER TABLE `sub_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sub_tasks`
--
ALTER TABLE `sub_tasks`
  ADD CONSTRAINT `sub_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
