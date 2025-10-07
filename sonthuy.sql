-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2025 at 10:08 PM
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
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_class_room`
--

INSERT INTO `tbl_class_room` (`id`, `code`, `title`, `content`, `date_start`, `date_end`, `user_id`, `status`, `create_at`) VALUES
(2, 141120460, '1ADT2025', 'Lớp một năm 2025', '2025-07-25', '2026-07-09', 2, 1, '2025-07-25 22:53:18'),
(3, 980932955, '2ADT2025', 'Lớp học năm học 2025', '2025-01-01', '2025-12-16', 0, 1, '2025-10-03 01:48:21');

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

--
-- Dumping data for table `tbl_group_role`
--

INSERT INTO `tbl_group_role` (`id`, `code`, `title`, `roles`, `status`, `create_at`) VALUES
(1, 1759428844, 'Giáo viên', '3,4,5,6,7,8,8_1,8_2,8_3,9,9_1,9_2,9_3,10,10_1,10_2,10_3,11,12,12_1,12_2,12_3,13,13_1,13_2,13_3,13_6', 1, '2025-10-03 01:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson`
--

CREATE TABLE `tbl_lesson` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `tbl_lesson`
--
DELIMITER $$
CREATE TRIGGER `del_lesson_extra_after_del_lesson` AFTER DELETE ON `tbl_lesson` FOR EACH ROW BEGIN
DELETE FROM tbl_lesson_dc WHERE lesson_id = old.id;
DELETE FROM tbl_lesson_media WHERE lesson_id = old.id;
DELETE FROM tbl_lesson_card WHERE lesson_id = old.id;
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
  `lesson_id` int(11) NOT NULL,
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
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_lesson_cate`
--

INSERT INTO `tbl_lesson_cate` (`id`, `code`, `parent_id`, `title`, `content`, `image`, `status`, `create_at`) VALUES
(2, 468929080, 0, 'Sách lớp 1', 'Bài học dành cho lớp 1', '1759772533_lesson_cate.jpg', 1, '2025-10-07 00:42:13'),
(7, 473266396, 0, 'Sách lớp 2', 'Bài học dành cho lớp 2', '1759772569_lesson_cate.jpg', 1, '2025-10-07 00:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson_dc`
--

CREATE TABLE `tbl_lesson_dc` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
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
  `lesson_id` int(11) NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `order_media` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `source_edu` int(11) NOT NULL COMMENT '1 là câu hỏi thuộc bài học; 2 là câu hỏi từ vựng, 3 là câu hỏi bài kiểm tra',
  `lesson_id` int(11) NOT NULL,
  `type_question` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `cate_vocab_id` int(11) NOT NULL COMMENT 'chỉ điền giá trị khi câu hỏi thuộc  dạng câu hỏi của từ vựng',
  `test_cate_id` int(11) NOT NULL COMMENT 'chỉ điền khi câu hỏi thuộc câu hỏi của bài kiểm tra, bài test',
  `level` int(11) NOT NULL COMMENT 'chỉ điền khi câu hỏi thuộc bài kiểm tra, bài test'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Danh sách câu hỏi';

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `code`, `source_edu`, `lesson_id`, `type_question`, `title`, `file`, `status`, `create_at`, `cate_vocab_id`, `test_cate_id`, `level`) VALUES
(2, 700727103, 1, 2, 1, 'Trái đất quay quanh Mặt trời đúng hay sai?', '1758387319_700727103.jpg', 1, '2025-09-20 23:55:19', 0, 0, 0),
(3, 229145667, 1, 2, 2, 'Thủ đô của Việt Nam là?', '1758388059_229145667.jpg', 1, '2025-09-21 00:09:34', 0, 0, 0),
(4, 325750605, 1, 2, 3, 'Em hãy lựa chọn các con vật biết bay nhé!', '1758388367_325750605.jpg', 1, '2025-09-21 00:12:47', 0, 0, 0),
(5, 310556130, 1, 2, 4, 'Em hãy nối đáp án của cột A với đáp án của cột B', '', 1, '2025-09-25 16:07:53', 0, 0, 0),
(6, 890901372, 1, 2, 5, 'Kéo thả đáp án vào đúng ô nhé', '', 1, '2025-09-21 20:22:26', 0, 0, 0),
(7, 345711435, 1, 2, 6, 'Sắp xếp các chữ sau thành một từ có nghĩa', '', 1, '2025-09-21 20:25:46', 0, 0, 0),
(19, 491149882, 1, 2, 5, 'fsdgsdfg', '', 1, '2025-09-26 00:49:56', 0, 0, 0),
(20, 20471154, 2, 0, 1, 'Trái đất quay quanh mặt trời đúng hay sai?', '1759000814_20471154.jpg', 1, '2025-09-28 02:20:14', 4, 0, 0),
(21, 7038933, 2, 0, 2, 'Thủ đô của Việt Nam là?', '', 1, '2025-09-29 23:54:24', 4, 0, 0),
(22, 11411332, 2, 0, 3, 'Loài vật nào bay trên trời?', '', 1, '2025-09-29 23:56:22', 4, 0, 0),
(23, 97693426, 2, 0, 6, 'Hãy sắp xếp các chữ cái sau thành một từ có nghĩa?', '', 1, '2025-09-30 00:00:11', 4, 0, 0),
(25, 39388934, 2, 0, 4, 'Nối đáp án ở cột A với cột B', '', 1, '2025-09-30 00:18:56', 4, 0, 0),
(26, 31552392, 2, 0, 5, 'dafasdfasdfas', '', 1, '2025-10-01 06:59:33', 4, 0, 0),
(27, 84010105, 3, 0, 1, 'ấdfasfsda', '1759514056_84010105.mp4', 1, '2025-10-04 00:54:16', 0, 3, 1),
(28, 64728835, 3, 0, 2, 'dsafasdfsadf', '1759514581_64728835.mp4', 1, '2025-10-04 01:03:01', 0, 3, 1),
(29, 25984026, 3, 0, 4, 'gkjgfhfgjdj', '1759514864_25984026.mp4', 1, '2025-10-04 01:07:44', 0, 1, 1),
(30, 50718841, 3, 0, 5, 'ADasdaSD', '1759517134_50718841.mp3', 1, '2025-10-04 01:45:34', 0, 1, 1);

--
-- Triggers `tbl_question`
--
DELIMITER $$
CREATE TRIGGER `del_detail_question_after_del_question` AFTER DELETE ON `tbl_question` FOR EACH ROW BEGIN
	DELETE FROM tbl_question_true_false WHERE code_question = old.code;
    DELETE FROM  tbl_question_one_true WHERE code_question = old.code;
    DELETE FROM tbl_question_multiple_true WHERE code_question = old.code;
    DELETE FROM tbl_question_match WHERE code_question = old.code;
    DELETE FROM tbl_question_drag_drop_target WHERE code_question = old.code;
    DELETE FROM tbl_question_drag_drop_item WHERE code_question = old.code;
    DELETE FROM tbl_question_sort_alphabet WHERE code_question = old.code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_drag_drop_item`
--

CREATE TABLE `tbl_question_drag_drop_item` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_question` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `id_temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dạng câu hỏi kéo thả - Item';

--
-- Dumping data for table `tbl_question_drag_drop_item`
--

INSERT INTO `tbl_question_drag_drop_item` (`id`, `code`, `code_question`, `target_id`, `title`, `file`, `status`, `id_temp`) VALUES
(1, 1758460915, 890901372, 3, 'a', '', 1, 0),
(2, 1758460920, 890901372, 3, 'b', '', 1, 0),
(3, 1758460927, 890901372, 4, 'c', '', 1, 0),
(4, 1758460930, 890901372, 4, 'd', '', 1, 0),
(23, 1758822596, 491149882, 79147, 'a', '1758822585_answer_1115.png', 1, 0),
(24, 1758822596, 491149882, 79147, 'b', '1758822588_answer_6735.png', 1, 0),
(25, 1758822596, 491149882, 72439, 'c', '1758822591_answer_6115.jpg', 1, 0),
(26, 1758822596, 491149882, 72439, 'd', '1758822593_answer_7652.jpg', 1, 0),
(27, 1759276773, 31552392, 87997, '', '1759276723_vocab_drag_drop_5289.png', 1, 0),
(28, 1759276773, 31552392, 87997, '', '1759276737_vocab_drag_drop_2681.jpg', 1, 0),
(29, 1759276773, 31552392, 0, '', '1759276754_vocab_drag_drop_8623.png', 1, 0),
(30, 1759276773, 31552392, 0, '', '1759276763_vocab_drag_drop_5379.jpg', 1, 0),
(33, 1759517134, 50718841, 95000, '1', '', 1, 0),
(34, 1759517134, 50718841, 95000, '2', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_drag_drop_target`
--

CREATE TABLE `tbl_question_drag_drop_target` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_question` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `id_temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dạng câu hỏi kéo thả - Target';

--
-- Dumping data for table `tbl_question_drag_drop_target`
--

INSERT INTO `tbl_question_drag_drop_target` (`id`, `code`, `code_question`, `title`, `file`, `status`, `id_temp`) VALUES
(3, 1758460889, 890901372, '1', '', 1, 0),
(4, 1758460893, 890901372, '2', '', 1, 0),
(25, 1758822596, 491149882, '1', '1758822580_target_1614.jpg', 1, 79147),
(26, 1758822596, 491149882, '2', '1758822583_target_9348.webp', 1, 72439),
(27, 1759276773, 31552392, 'Animal', '', 1, 87997),
(28, 1759276773, 31552392, 'Tool', '', 1, 22337),
(31, 1759517134, 50718841, 'A', '', 1, 95000),
(32, 1759517134, 50718841, 'B', '', 1, 63962);

--
-- Triggers `tbl_question_drag_drop_target`
--
DELIMITER $$
CREATE TRIGGER `update_status_answer_drag_drop_after_update_drag_drop` AFTER DELETE ON `tbl_question_drag_drop_target` FOR EACH ROW DELETE FROM tbl_question_drag_drop_item WHERE target_id = old.id_temp
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_match`
--

CREATE TABLE `tbl_question_match` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_question` int(11) NOT NULL,
  `answer_a` text COLLATE utf8_unicode_ci NOT NULL,
  `file_a` text COLLATE utf8_unicode_ci NOT NULL,
  `answer_b` text COLLATE utf8_unicode_ci NOT NULL,
  `file_b` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `id_temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dạng câu hỏi nối';

--
-- Dumping data for table `tbl_question_match`
--

INSERT INTO `tbl_question_match` (`id`, `code`, `code_question`, `answer_a`, `file_a`, `answer_b`, `file_b`, `status`, `id_temp`) VALUES
(55, 1758791273, 310556130, 'Chim', '1758791018_3774.png', 'Bird', '1758791269_4295.png', 1, 0),
(57, 1759166336, 39388934, 'Chim', '1759166319_vocab_match_7246.png', 'Bird', '1759166327_vocab_match_3952.png', 1, 0),
(58, 1759514864, 25984026, 'a', '', 'b', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_match_temp`
--

CREATE TABLE `tbl_question_match_temp` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_question` int(11) NOT NULL,
  `answer_a` text COLLATE utf8_unicode_ci NOT NULL,
  `file_a` text COLLATE utf8_unicode_ci NOT NULL,
  `answer_b` text COLLATE utf8_unicode_ci NOT NULL,
  `file_b` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `id_temp` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dạng câu hỏi nối';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_multiple_true`
--

CREATE TABLE `tbl_question_multiple_true` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_question` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dạng câu hỏi chọn nhiều đáp án đúng';

--
-- Dumping data for table `tbl_question_multiple_true`
--

INSERT INTO `tbl_question_multiple_true` (`id`, `code`, `code_question`, `answer`, `title`, `file`) VALUES
(1, 1758388253, 325750605, 1, 'Chim', '1758388253_25754.png'),
(2, 1758388253, 325750605, 1, 'Cnn bướm', '1758388253_48265.jpg'),
(3, 1758388253, 325750605, 0, 'Con chó', '1758388253_88226.png'),
(4, 1758388253, 325750605, 0, 'Con cá', '1758388253_20657.jpg'),
(5, 1759164982, 11411332, 1, 'Chim', ''),
(6, 1759164982, 11411332, 1, 'Bướm', ''),
(7, 1759164982, 11411332, 0, 'Chó', ''),
(8, 1759164982, 11411332, 0, 'Cá', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_one_true`
--

CREATE TABLE `tbl_question_one_true` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_question` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dạng câu hỏi chọn 1 đáp án đúng';

--
-- Dumping data for table `tbl_question_one_true`
--

INSERT INTO `tbl_question_one_true` (`id`, `code`, `code_question`, `answer`, `title`, `file`) VALUES
(1, 1758388059, 229145667, 1, 'Hà Nội', '1758388059_87551.jpg'),
(2, 1758388059, 229145667, 0, 'Thành phố Hồ Chí Minh', '1758388059_52974.jpg'),
(3, 1758388059, 229145667, 0, 'Đà Nẵng', '1758388059_50515.webp'),
(4, 1758388059, 229145667, 0, 'Huế', '1758388059_33005.jpg'),
(5, 1759164864, 7038933, 1, 'Hà Nội', ''),
(6, 1759164864, 7038933, 0, 'Thành phố Hồ Chí Minh', ''),
(7, 1759164864, 7038933, 0, 'Huế', ''),
(8, 1759164864, 7038933, 0, 'Đà Nẵng', ''),
(9, 1759514581, 64728835, 1, 'a', ''),
(10, 1759514581, 64728835, 0, 'd', ''),
(11, 1759514581, 64728835, 0, 'f', ''),
(12, 1759514581, 64728835, 0, 'af', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_sort_alphabet`
--

CREATE TABLE `tbl_question_sort_alphabet` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_question` int(11) NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dạng câu hỏi sắp xếp chữ cái';

--
-- Dumping data for table `tbl_question_sort_alphabet`
--

INSERT INTO `tbl_question_sort_alphabet` (`id`, `code`, `code_question`, `answer`) VALUES
(1, 1758461147, 345711435, 'HELLO'),
(2, 1759165212, 97693426, 'ELEPHANT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_true_false`
--

CREATE TABLE `tbl_question_true_false` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `code_question` int(11) NOT NULL,
  `answer` int(11) NOT NULL COMMENT '1 là đúng; 2 là sai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dạnh câu hỏi đúng sai';

--
-- Dumping data for table `tbl_question_true_false`
--

INSERT INTO `tbl_question_true_false` (`id`, `code`, `code_question`, `answer`) VALUES
(1, 1758387319, 700727103, 1),
(2, 1759000814, 20471154, 1),
(3, 1759514056, 84010105, 1);

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
(1, 0, 'Lớp học', 'class_room', '1,2,3,5', 1, 'life-bouy', 0, 1),
(2, 0, 'Nhân sự', 'teacher', '1,2,3', 2, 'users', 0, 1),
(3, 0, 'Học sinh', '#', '', 3, 'graduation-cap', 0, 1),
(4, 3, 'Thông tin học sinh', 'students', '1,2,3', 1, 'a', 0, 1),
(5, 3, 'Kiểm tra đầu vào', '#', '1,2,3', 2, 'a', 0, 1),
(6, 3, 'Chuyên cần', 'muster', '', 3, 'a', 0, 1),
(7, 0, 'Bài giảng', '#', '', 4, 'folder-open-o', 0, 1),
(8, 7, 'Danh mục', 'lesson_cate', '1,2,3', 1, 'a', 0, 1),
(9, 7, 'Quản lý bài giảng', 'lesson', '1,2,3', 2, 'a', 0, 1),
(11, 0, 'Kiểm tra/Thi', '#', '', 6, 'pencil-square-o', 0, 1),
(12, 11, 'Danh mục', 'test_cate', '1,2,3', 1, 'a', 0, 1),
(13, 11, 'Quản lý thi/kiểm tra', 'test', '1,2,3,6', 2, 'a', 0, 1),
(14, 0, 'Quản lý người dùng', '#', '', 7, 'user', 0, 1),
(15, 14, 'Tài khoản học sinh', '#', '1,2,3', 1, 'a', 0, 1),
(16, 14, 'Người dùng', 'users', '', 2, 'a', 0, 1),
(17, 14, 'Phân quyền', 'group_role', '', 3, 'a', 0, 1),
(18, 0, 'Báo cáo', '#', '', 8, 'bar-chart', 0, 1),
(19, 0, 'Từ vựng', '#', '', 5, 'cubes', 0, 1),
(20, 19, 'Danh mục', 'vocab_cate', '1,2,3', 1, 'a', 0, 1),
(21, 19, 'Quản lý câu hỏi', 'vocabulary', '1,2,3', 2, 'a', 0, 1);

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
-- Table structure for table `tbl_test_cate`
--

CREATE TABLE `tbl_test_cate` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng lưu thông tin danh mục bài kiểm tra - Test';

--
-- Dumping data for table `tbl_test_cate`
--

INSERT INTO `tbl_test_cate` (`id`, `code`, `parent_id`, `title`, `content`, `status`, `create_at`) VALUES
(1, 34386557, 0, 'Demo', 'Danh mục cha để lưu trữ các bài kiểm tra - bài test', 1, '2025-09-05 23:58:38'),
(3, 911277307, 1, 'Lớp 1', 'Các bài test liên quan đến lớp 1', 1, '2025-09-12 01:27:28');

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
(1, 123456789, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 0, '2025-10-08 02:07:33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '22c2a412685221143b1fe1d74a09b18f2ad97be8', 1, 1, '2025-07-22 19:37:03'),
(2, 1759338857, 'nguyenvana', '7ce0359f12857f2a90c7de465f40a95f01cb5da9', 3, 1, '2025-10-03 01:49:08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '1f873d66aa7e25e2bc5bd3c1a225e210da9b36a0', 1, 0, '2025-10-02 00:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vocab_cate`
--

CREATE TABLE `tbl_vocab_cate` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng lưu thông tin danh mục từ vựng';

--
-- Dumping data for table `tbl_vocab_cate`
--

INSERT INTO `tbl_vocab_cate` (`id`, `code`, `title`, `image`, `status`, `create_at`) VALUES
(3, 1757008292, 'Động vật', '', 1, '2025-09-05 00:51:32'),
(4, 1757008300, 'Gia đình', '', 1, '2025-09-05 00:51:40'),
(5, 1759863506, 'Đồ dùng học tập', '1759863506_vocab_cate.jpg', 1, '2025-10-08 01:59:06');

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
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_drag_drop_item`
--
ALTER TABLE `tbl_question_drag_drop_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_drag_drop_target`
--
ALTER TABLE `tbl_question_drag_drop_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_match`
--
ALTER TABLE `tbl_question_match`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_match_temp`
--
ALTER TABLE `tbl_question_match_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_multiple_true`
--
ALTER TABLE `tbl_question_multiple_true`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_one_true`
--
ALTER TABLE `tbl_question_one_true`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_sort_alphabet`
--
ALTER TABLE `tbl_question_sort_alphabet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_true_false`
--
ALTER TABLE `tbl_question_true_false`
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
-- Indexes for table `tbl_test_cate`
--
ALTER TABLE `tbl_test_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vocab_cate`
--
ALTER TABLE `tbl_vocab_cate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_class_room`
--
ALTER TABLE `tbl_class_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_group_role`
--
ALTER TABLE `tbl_group_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_lesson`
--
ALTER TABLE `tbl_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_lesson_card`
--
ALTER TABLE `tbl_lesson_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_lesson_cate`
--
ALTER TABLE `tbl_lesson_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_lesson_dc`
--
ALTER TABLE `tbl_lesson_dc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_lesson_media`
--
ALTER TABLE `tbl_lesson_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_question_drag_drop_item`
--
ALTER TABLE `tbl_question_drag_drop_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_question_drag_drop_target`
--
ALTER TABLE `tbl_question_drag_drop_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_question_match`
--
ALTER TABLE `tbl_question_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_question_match_temp`
--
ALTER TABLE `tbl_question_match_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_question_multiple_true`
--
ALTER TABLE `tbl_question_multiple_true`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_question_one_true`
--
ALTER TABLE `tbl_question_one_true`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_question_sort_alphabet`
--
ALTER TABLE `tbl_question_sort_alphabet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_question_true_false`
--
ALTER TABLE `tbl_question_true_false`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- AUTO_INCREMENT for table `tbl_test_cate`
--
ALTER TABLE `tbl_test_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_vocab_cate`
--
ALTER TABLE `tbl_vocab_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
