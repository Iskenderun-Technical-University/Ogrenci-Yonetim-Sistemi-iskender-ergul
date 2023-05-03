-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Nis 2023, 14:07:42
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ogrencidatabase`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_giris`
--

CREATE TABLE `admin_giris` (
  `admin_id` int(11) NOT NULL,
  `admin_isim` varchar(100) NOT NULL,
  `admin_sifre` int(11) NOT NULL,
  `admin_yetki` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `admin_giris`
--

INSERT INTO `admin_giris` (`admin_id`, `admin_isim`, `admin_sifre`, `admin_yetki`) VALUES
(2, 'iskender', 123456, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurslar`
--

CREATE TABLE `kurslar` (
  `kurs_id` int(11) NOT NULL,
  `kurs_ad` varchar(50) NOT NULL,
  `kurs_saat` varchar(50) NOT NULL,
  `kurs_aciklama` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kurslar`
--

INSERT INTO `kurslar` (`kurs_id`, `kurs_ad`, `kurs_saat`, `kurs_aciklama`) VALUES
(1, 'Biyoloji', '13', 'Biyoloji kursu'),
(2, 'Matematik', '15', 'Matematik Dersi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci`
--

CREATE TABLE `ogrenci` (
  `ogrenci_id` int(5) NOT NULL,
  `ogrenci_isim` varchar(20) NOT NULL,
  `ogrenci_soyisim` varchar(20) NOT NULL,
  `ogrenci_cinsiyet` varchar(20) NOT NULL,
  `ogrenci_telefon` varchar(20) NOT NULL,
  `ogrenci_adres` text NOT NULL,
  `ogrenci_fotograf` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ogrenci`
--

INSERT INTO `ogrenci` (`ogrenci_id`, `ogrenci_isim`, `ogrenci_soyisim`, `ogrenci_cinsiyet`, `ogrenci_telefon`, `ogrenci_adres`, `ogrenci_fotograf`) VALUES
(23, 'İskender', 'mehmet', 'erkek', '123456', 'ova mahallesi adana', 'dimg/2494020220620_195052.jpg'),
(24, 'ahmet', 'mehmet', 'erkek', '123456', 'ova mahallesi adana', 'dimg/2750020220519_191731.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogretmen`
--

CREATE TABLE `ogretmen` (
  `ogretmen_id` int(11) NOT NULL,
  `ogretmen_ad` varchar(100) NOT NULL,
  `ogretmen_soyad` varchar(50) NOT NULL,
  `ogretmen_brans` varchar(50) NOT NULL,
  `ogretmen_maas` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ogretmen`
--

INSERT INTO `ogretmen` (`ogretmen_id`, `ogretmen_ad`, `ogretmen_soyad`, `ogretmen_brans`, `ogretmen_maas`) VALUES
(8, 'iskender', 'ergül', 'Biyoloji', 123456.00);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_giris`
--
ALTER TABLE `admin_giris`
  ADD PRIMARY KEY (`admin_id`);

--
-- Tablo için indeksler `kurslar`
--
ALTER TABLE `kurslar`
  ADD PRIMARY KEY (`kurs_id`);

--
-- Tablo için indeksler `ogrenci`
--
ALTER TABLE `ogrenci`
  ADD PRIMARY KEY (`ogrenci_id`);

--
-- Tablo için indeksler `ogretmen`
--
ALTER TABLE `ogretmen`
  ADD PRIMARY KEY (`ogretmen_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_giris`
--
ALTER TABLE `admin_giris`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `kurslar`
--
ALTER TABLE `kurslar`
  MODIFY `kurs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenci`
--
ALTER TABLE `ogrenci`
  MODIFY `ogrenci_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `ogretmen`
--
ALTER TABLE `ogretmen`
  MODIFY `ogretmen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
