-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 27, 2025 at 10:25 PM
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
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_lesson`
--

INSERT INTO `tbl_lesson` (`id`, `code`, `cate_id`, `title`, `content`, `status`, `create_at`) VALUES
(2, 12069348, 3, 'Unit 1: Hello', 'Unit 1 - Hello: Làm quen với tiếng anh', 1, '2025-08-01 00:59:12'),
(7, 713188288, 3, 'asdf', 'asdf', 1, '2025-09-26 01:59:35');

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

--
-- Dumping data for table `tbl_lesson_card`
--

INSERT INTO `tbl_lesson_card` (`id`, `code`, `lesson_id`, `image`, `order_card`, `status`, `create_at`) VALUES
(1, 1475848237, 2, '1754204406_1475848237.jpg', 1, 1, '2025-08-03 14:00:06'),
(2, 578861597, 2, '1754204406_578861597.jpg', 2, 1, '2025-08-03 14:00:06'),
(3, 874408756, 2, '1754204406_874408756.jpg', 3, 1, '2025-08-03 14:00:06'),
(4, 141914085, 2, '1754204406_141914085.jpg', 4, 1, '2025-08-03 14:00:06'),
(5, 171844482, 2, '1754204406_171844482.jpg', 5, 1, '2025-08-03 14:00:06'),
(6, 1029923362, 2, '1754204406_1029923362.jpg', 6, 1, '2025-08-03 14:00:06'),
(7, 403327067, 2, '1754204406_403327067.jpg', 7, 1, '2025-08-03 14:00:06'),
(8, 1195292699, 2, '1754204406_1195292699.jpg', 8, 1, '2025-08-03 14:00:06');

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
(9, 207109423, 7, 'Tuần 2', 'Bài học tuần 2', 1, '2025-07-29 01:47:03'),
(10, 359016084, 7, 'Tuần 3', 'Bài học tuần 3', 1, '2025-07-30 00:16:50');

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

--
-- Dumping data for table `tbl_lesson_dc`
--

INSERT INTO `tbl_lesson_dc` (`id`, `code`, `lesson_id`, `image`, `order_dc`, `status`, `create_at`) VALUES
(2, 1691560040, 2, '1754063946_1691560040.jpg', 2, 1, '2025-08-01 22:59:06'),
(3, 2118601411, 2, '1754063946_2118601411.jpg', 3, 1, '2025-08-01 22:59:06'),
(5, 1815825365, 2, '1754068880_1815825365.jpg', 4, 1, '2025-08-02 00:21:20'),
(6, 503649019, 2, '1754092832_503649019.jpg', 1, 1, '2025-08-02 07:00:32');

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

--
-- Dumping data for table `tbl_lesson_media`
--

INSERT INTO `tbl_lesson_media` (`id`, `code`, `lesson_id`, `file`, `order_media`, `status`, `create_at`) VALUES
(2, 1124666599, 2, '1754093166_1124666599.mp4', 2, 1, '2025-08-02 07:06:06'),
(3, 1096038744, 2, '1754093166_1096038744.mp4', 3, 1, '2025-08-02 07:06:06'),
(4, 170194033, 2, '1754093166_170194033.mp4', 4, 1, '2025-08-02 07:06:06'),
(5, 1879220943, 2, '1754150170_1879220943.mp4', 1, 1, '2025-08-02 22:56:10');

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
(20, 20471154, 2, 0, 1, 'Trái đất quay quanh mặt trời đúng hay sai?', '1759000814_20471154.jpg', 1, '2025-09-28 02:20:14', 4, 0, 0);

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
(26, 1758822596, 491149882, 72439, 'd', '1758822593_answer_7652.jpg', 1, 0);

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
(26, 1758822596, 491149882, '2', '1758822583_target_9348.webp', 1, 72439);

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
(55, 1758791273, 310556130, 'Chim', '1758791018_3774.png', 'Bird', '1758791269_4295.png', 1, 0);

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
(4, 1758388253, 325750605, 0, 'Con cá', '1758388253_20657.jpg');

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
(4, 1758388059, 229145667, 0, 'Huế', '1758388059_33005.jpg');

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
(1, 1758461147, 345711435, 'HELLO');

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
(2, 1759000814, 20471154, 1);

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
(10, 7, 'Từ vựng', 'vocabulary', '', 3, 'a', 0, 1),
(11, 0, 'Kiểm tra/Thi', '#', '', 5, 'pencil-square-o', 0, 1),
(12, 11, 'Danh mục', 'test_cate', '', 1, 'a', 0, 1),
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
(1, 123456789, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 0, '2025-09-28 02:24:09', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', 'a9700ecf6caf074b15043addaae3dc0c899673b7', 1, 1, '2025-07-22 19:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vocab_cate`
--

CREATE TABLE `tbl_vocab_cate` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng lưu thông tin danh mục từ vựng';

--
-- Dumping data for table `tbl_vocab_cate`
--

INSERT INTO `tbl_vocab_cate` (`id`, `code`, `title`, `status`, `create_at`) VALUES
(2, 1757008283, 'Trái cây', 1, '2025-09-05 00:51:23'),
(3, 1757008292, 'Động vật', 1, '2025-09-05 00:51:32'),
(4, 1757008300, 'Gia đình', 1, '2025-09-05 00:51:40');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_lesson_card`
--
ALTER TABLE `tbl_lesson_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_lesson_cate`
--
ALTER TABLE `tbl_lesson_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_lesson_dc`
--
ALTER TABLE `tbl_lesson_dc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_lesson_media`
--
ALTER TABLE `tbl_lesson_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_question_drag_drop_item`
--
ALTER TABLE `tbl_question_drag_drop_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_question_drag_drop_target`
--
ALTER TABLE `tbl_question_drag_drop_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_question_match`
--
ALTER TABLE `tbl_question_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_question_match_temp`
--
ALTER TABLE `tbl_question_match_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_question_multiple_true`
--
ALTER TABLE `tbl_question_multiple_true`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_question_one_true`
--
ALTER TABLE `tbl_question_one_true`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_question_sort_alphabet`
--
ALTER TABLE `tbl_question_sort_alphabet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_question_true_false`
--
ALTER TABLE `tbl_question_true_false`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `tbl_test_cate`
--
ALTER TABLE `tbl_test_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_vocab_cate`
--
ALTER TABLE `tbl_vocab_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
