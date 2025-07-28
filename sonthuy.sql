-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 28, 2025 at 09:59 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sonthuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_room`
--

CREATE TABLE `tbl_class_room` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_class_room`
--

INSERT INTO `tbl_class_room` (`id`, `code`, `title`, `content`, `date_start`, `date_end`, `status`, `create_at`) VALUES
(2, 141120460, '1ADT2025', 'Lớp một năm 2025', '2025-07-25', '2026-07-09', 1, '2025-07-25 22:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_role`
--

CREATE TABLE `tbl_group_role` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `roles` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson`
--

CREATE TABLE `tbl_lesson` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `tbl_lesson`
--
DELIMITER $$
CREATE TRIGGER `del_lesson_extra_after_del_lesson` AFTER DELETE ON `tbl_lesson` FOR EACH ROW BEGIN
DELETE FROM tbl_lesson_dc WHERE code_lesson = old.code;
DELETE FROM tbl_lesson_media WHERE code_lesson = old.code;
DELETE FROM tbl_lesson_card WHERE code_lesson = old.code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson_card`
--

CREATE TABLE `tbl_lesson_card` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_lesson` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `order_card` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson_cate`
--

CREATE TABLE `tbl_lesson_cate` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_lesson_cate`
--

INSERT INTO `tbl_lesson_cate` (`id`, `code`, `parent_id`, `title`, `content`, `status`, `create_at`) VALUES
(2, 468929080, 0, 'Sách lớp 1', 'Bài học dành cho lớp 1', 1, '2025-07-28 23:43:43'),
(3, 121386087, 2, 'Tuần 1', 'Bài học của tuần 1', 1, '2025-07-28 23:44:09'),
(4, 983603568, 2, 'Tuần 2', 'Bài học tuần 2', 1, '2025-07-28 23:44:28'),
(5, 741147367, 2, 'Tuần 3', 'Bài học tuần 3', 1, '2025-07-28 23:44:56'),
(6, 748955283, 2, 'Tuần 4', 'Bài học tuần 4', 1, '2025-07-28 23:45:19'),
(7, 473266396, 0, 'Sách lớp 2', 'Bài học dành cho lớp 2', 1, '2025-07-28 23:46:07'),
(8, 517997481, 7, 'Tuần 1', 'Bài học tuần 1', 1, '2025-07-28 23:46:37'),
(9, 207109423, 7, 'Tuần 2', 'Bài học tuần 2', 1, '2025-07-29 01:47:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson_dc`
--

CREATE TABLE `tbl_lesson_dc` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_lesson` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `order_dc` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson_media`
--

CREATE TABLE `tbl_lesson_media` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_lesson` int(11) NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `order_media` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `functions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_position` int(11) NOT NULL,
  `icon` text COLLATE utf8_unicode_ci,
  `is_submenu` int(11) NOT NULL DEFAULT '0' COMMENT '0 là có,1 là không',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `parent_id`, `title`, `link`, `functions`, `order_position`, `icon`, `is_submenu`, `status`) VALUES
(1, 0, 'Lớp học', 'class_room', '1,2,3', 1, 'life-bouy', 0, 1),
(2, 0, 'Nhân sự', 'teacher', '1,2,3', 2, 'users', 0, 1),
(3, 0, 'Học sinh', '#', '', 3, 'graduation-cap', 0, 1),
(4, 3, 'Thông tin học sinh', 'students', '1,2,3', 1, 'a', 0, 1),
(5, 3, 'Kiểm tra đầu vào', '#', '1,2,3', 2, 'a', 0, 1),
(6, 3, 'Chuyên cần', 'muster', '', 3, 'a', 0, 1),
(7, 0, 'Bài giảng', '#', '', 4, 'folder-open-o', 0, 1),
(8, 7, 'Danh mục', 'lesson_cate', '1,2,3', 1, 'a', 0, 1),
(9, 7, 'Quản lý bài giảng', 'lesson', '1,2,3', 2, 'a', 0, 1),
(10, 7, 'Từ vựng', '#', '', 3, 'a', 0, 1),
(11, 0, 'Kiểm tra/Thi', '#', '', 5, 'pencil-square-o', 0, 1),
(12, 11, 'Danh mục', '#', '', 1, 'a', 0, 1),
(13, 11, 'Quản lý thi/kiểm tra', '#', '', 2, 'a', 0, 1),
(14, 0, 'Quản lý người dùng', '#', '', 6, 'user', 0, 1),
(15, 14, 'Tài khoản học sinh', '#', '', 1, 'a', 0, 1),
(16, 14, 'Người dùng', 'users', '', 2, 'a', 0, 1),
(17, 14, 'Phân quyền', '#', '', 3, 'a', 0, 1),
(18, 0, 'Báo cáo', '#', '', 7, 'bar-chart', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng lưu thông tin học sinh';

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `code`, `fullname`, `birthday`, `gender`, `address`, `email`, `class_id`, `status`, `create_at`) VALUES
(2, 879724973, 'Dương Thanh Tùng', '2016-04-12', 1, 'Thôn Đào Xuyên, Xã Bát Tràng, Thành phố Hà Nội', 'duongthanhtung2016@gmail.com', 2, 1, '2025-07-26 18:42:18');

--
-- Triggers `tbl_student`
--
DELIMITER $$
CREATE TRIGGER `del_relation_after_del_student` AFTER DELETE ON `tbl_student` FOR EACH ROW DELETE FROM tbl_student_relation WHERE code_student = old.code
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_muster`
--

CREATE TABLE `tbl_student_muster` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_muster` date NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_student_muster`
--

INSERT INTO `tbl_student_muster` (`id`, `code`, `class_id`, `student_id`, `date_muster`, `create_at`) VALUES
(4, 1753544732, 2, 2, '2025-07-26', '2025-07-26 22:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_relation`
--

CREATE TABLE `tbl_student_relation` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_student` int(11) NOT NULL,
  `relation_id` int(11) NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng lưu thông tin liên hệ của học sinh';

--
-- Dumping data for table `tbl_student_relation`
--

INSERT INTO `tbl_student_relation` (`id`, `code`, `code_student`, `relation_id`, `fullname`, `phone`, `email`) VALUES
(5, 1753530196, 879724973, 2, 'Nguyễn Thị Minh Huệ', '0349697096', 'minhhue16111991@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` int(11) NOT NULL,
  `level` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng lưu thông tin giáo viên';

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `code`, `fullname`, `birthday`, `gender`, `level`, `address`, `phone`, `email`, `image`, `status`, `create_at`) VALUES
(3, 559996216, 'Nguyễn Văn A', '2000-04-23', 1, 'Đại học', 'Phường Long Biên, Thành phố Hà Nội', '0987654321', 'abcd@gmail.com', '1753379618_559996216.jpg', 1, '2025-07-25 00:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `group_role_id` int(11) NOT NULL,
  `last_login` text COLLATE utf8_unicode_ci NOT NULL,
  `info_login` text COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `change_pass` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng thông tin người dùng';

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `code`, `username`, `password`, `personnel_id`, `group_role_id`, `last_login`, `info_login`, `token`, `status`, `change_pass`, `create_at`) VALUES
(1, 123456789, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 0, '2025-07-28 23:36:38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0', '4902eba308219ed0043b9863d5b0e465a5ac8f16', 1, 1, '2025-07-22 19:37:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_class_room`
--
ALTER TABLE `tbl_class_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group_role`
--
ALTER TABLE `tbl_group_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lesson`
--
ALTER TABLE `tbl_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lesson_card`
--
ALTER TABLE `tbl_lesson_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lesson_cate`
--
ALTER TABLE `tbl_lesson_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lesson_dc`
--
ALTER TABLE `tbl_lesson_dc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lesson_media`
--
ALTER TABLE `tbl_lesson_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student_muster`
--
ALTER TABLE `tbl_student_muster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student_relation`
--
ALTER TABLE `tbl_student_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_class_room`
--
ALTER TABLE `tbl_class_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_group_role`
--
ALTER TABLE `tbl_group_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_lesson`
--
ALTER TABLE `tbl_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_lesson_card`
--
ALTER TABLE `tbl_lesson_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_lesson_cate`
--
ALTER TABLE `tbl_lesson_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_lesson_dc`
--
ALTER TABLE `tbl_lesson_dc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_lesson_media`
--
ALTER TABLE `tbl_lesson_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_student_muster`
--
ALTER TABLE `tbl_student_muster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_student_relation`
--
ALTER TABLE `tbl_student_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
