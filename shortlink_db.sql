-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Sep 2019 pada 07.13
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shortlink_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `link`
--

CREATE TABLE `link` (
  `id` varchar(110) NOT NULL,
  `real_url` varchar(200) NOT NULL,
  `short_url` varchar(200) NOT NULL,
  `hit` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `link`
--

INSERT INTO `link` (`id`, `real_url`, `short_url`, `hit`, `datetime`) VALUES
('2W0ct', 'https://soulmategram.com/', 'http://localhost/short/2W0ct', 0, '2019-09-07 11:15:41'),
('6yt53', 'https://www.blogger.com/blogger.g?blogID=697895251696929370#overviewstats', 'http://localhost/short/6yt53', 0, '2019-09-07 05:02:06'),
('e1pKV', 'https://www.fec0de.me/', 'http://localhost/short/e1pKV', 0, '2019-09-07 04:26:03'),
('Rxnu1', 'https://www.facebook.com/', 'http://localhost/short/Rxnu1', 0, '2019-09-07 04:30:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
