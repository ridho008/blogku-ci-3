-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2021 at 02:52 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogku-ci-3`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi_artikel` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `gambar_artikel` varchar(256) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `dilihat` int(11) NOT NULL DEFAULT 0,
  `suka` int(11) NOT NULL DEFAULT 0,
  `dislike` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL COMMENT '0 = draft\r\n1 = publish'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul`, `isi_artikel`, `slug`, `gambar_artikel`, `id_kategori`, `tag`, `tanggal`, `id_penulis`, `dilihat`, `suka`, `dislike`, `status`) VALUES
(3, 'Mantap Gan', '&lt;p&gt;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque corporis, natus? Impedit in fugiat delectus. Sit ipsam suscipit quae atque consequuntur tempora nihil similique, rem eius fugiat accusantium necessitatibus dolores.&lt;/p&gt;', 'Mantap-Gan', 'cheat-god-of-war-2-ps2.jpg', 3, 'Berita', '2020-10-07', 3, 3, 0, 0, 1),
(5, 'Selamat Datang Blog', '&lt;p&gt;woke&lt;/p&gt;', 'Selamat-Datang', 'cara-hapus-virus-readme-eml.jpg', 1, 'Berita', '2020-10-08', 4, 2, 0, 0, 1),
(6, 'Mudah Hapus Virus Readme.eml runonce.exe Berhasil!', '&lt;p&gt;asdajksdf&lt;/p&gt;', 'Hapus-Virus-Readme.eml', 'cara-hapus-virus-readme-eml.jpg', 10, 'asd', '2020-10-12', 3, 52, 0, 0, 1),
(8, 'What is Lorem Ipsum?', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;', 'What-is-Lorem-Ipsum', 'photo1.png', 6, 'programmer', '2020-10-19', 3, 0, 0, 0, 1),
(9, 'Why do we use it?', '&lt;p&gt;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &amp;#39;Content here, content here&amp;#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &amp;#39;lorem ipsum&amp;#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&lt;/p&gt;', 'Why-do-we-use-it', 'photo3.jpg', 8, 'Js', '2020-10-19', 3, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dislike`
--

CREATE TABLE `dislike` (
  `id_dislike` int(11) NOT NULL,
  `id_artikel` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Teknologi'),
(3, 'HTML'),
(4, 'CSS'),
(5, 'PHP'),
(6, 'Javascript'),
(7, 'Java'),
(8, 'React JS'),
(9, 'Berita'),
(10, 'Linux'),
(11, 'Windows');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komen` int(11) NOT NULL,
  `id_artikel` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_komen` date NOT NULL,
  `isi` text NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komen`, `id_artikel`, `id_user`, `tgl_komen`, `isi`, `role`, `status`) VALUES
(1, 3, 7, '2020-10-10', 'Terima kasih Infonya gan', 3, 1),
(2, 6, 3, '2020-10-14', 'coba gan', 2, 1),
(3, 3, 3, '2020-10-14', 'Sama sma gan', 2, 1),
(4, 5, 7, '2020-10-15', 'masih belajar', 3, 1),
(5, 5, 3, '2020-10-15', 'iya gan', 2, 1),
(6, 6, 7, '2020-10-15', 'nyba juga', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nama_penulis` varchar(50) NOT NULL,
  `foto_penulis` varchar(256) NOT NULL,
  `desk_penulis` varchar(150) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `id_user`, `tgl_daftar`, `nama_penulis`, `foto_penulis`, `desk_penulis`, `status`) VALUES
(3, 3, '2020-10-07', 'Harun Surya', 'avatar041.png', 'Seorang Desainger & Web Develoment', 0),
(4, 4, '2020-10-07', 'Juki', 'user2-160x160.jpg', 'Seorang Blogger Profesional', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sukai`
--

CREATE TABLE `sukai` (
  `id_like` int(11) NOT NULL,
  `id_artikel` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sukai`
--

INSERT INTO `sukai` (`id_like`, `id_artikel`, `id_user`) VALUES
(9, 3, 7),
(10, 5, 7),
(11, 6, 7),
(12, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `nama_tamu` varchar(50) NOT NULL,
  `foto_tamu` varchar(256) DEFAULT NULL,
  `jk_tamu` enum('L','P') NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id_tamu`, `id_user`, `tgl_daftar`, `nama_tamu`, `foto_tamu`, `jk_tamu`, `status`) VALUES
(2, 7, '2020-10-10', 'Sandhika Galih', 'avatar51.png', 'L', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('1','2','3') NOT NULL COMMENT '1 = admin\r\n2 = penulis\r\n3 = tamu',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `status`) VALUES
(1, 'admin', '$2y$10$b078IWqEcnUr7OPqeh.v8eT6qyXpDNKKrinM3VpvL2vcLLJfYyxDO', '1', 0),
(2, 'penulis', '$2y$10$ocKCL9cGsHxci/NMVROD7OeQQ8JK8lPy7KuSP4c5N6OL1XgPXYnLu', '2', 0),
(3, 'Harun', '$2y$10$7xTu3w1pWXD.3JzJFzDm3.yAw.lScSlg8XCf4faFBsA2cwaZl/jii', '2', 0),
(4, 'Juki', '$2y$10$aIU/VXMVzY8vv.qJF55yP.IXsQvRQA.VVSpg5IQGliDm4j3a8N0Ea', '2', 0),
(5, 'asd', '$2y$10$ZhpBqNG.b.Tu7Zvb8cDP0OHUFABiAgsw7CPsGsnjRILaTHHsjldQq', '2', 0),
(7, 'sandika', '$2y$10$lRRYD9TPyVmCI2qn4vjO.uMXmHXGyOpqGgZ74u28RS0HFltQwW3Qq', '3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `dislike`
--
ALTER TABLE `dislike`
  ADD PRIMARY KEY (`id_dislike`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komen`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `sukai`
--
ALTER TABLE `sukai`
  ADD PRIMARY KEY (`id_like`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dislike`
--
ALTER TABLE `dislike`
  MODIFY `id_dislike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sukai`
--
ALTER TABLE `sukai`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
